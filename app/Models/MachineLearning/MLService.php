<?php

namespace App\Models\MachineLearning;

use Illuminate\Http\Request;
use Phpml\Association\Apriori;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use PhpScience\TextRank\Tool\StopWords\English;
use PhpScience\TextRank\TextRankFacade;
use App\Models\DocxConversion;
use App\Models\MachineLearning\StoreSampleData;
use App\Models\Jobs\Job;
use App\Models\Clients\Company;


use Smalot\PdfParser\Parser;

class MLService
{
    public function __construct()
    {
        ini_set('max_execution_time', 0);
        $this->api = new TextRankFacade();

        $stopWords = new English();
        $this->api->setStopWords($stopWords);

        #standford
        $this->stanfordStopwords =  file(public_path('/stanford_nl_stopwords.txt'));

        $this->skillwords =  array_chunk(file(public_path('/skill_words.txt'), FILE_IGNORE_NEW_LINES), 100, true);
        // Remove line breaks and spaces from stopwords
        $this->stanfordStopwords = array_map(function ($x) {
            return trim(strtolower($x));
        }, $this->stanfordStopwords);
    }

    public function setDataIntoDB($fileDir)
    {
        $begin = memory_get_usage();
        $maxId = Company::max('id');
        $minId = Company::min('id');
        $industriesRandom =   ["Aerospace industry", "Agriculture",
        "Fishing industry","Timber industry","Tobacco industry","Chemical industry",
        "Pharmaceutical industry","Computer industry","Software industry",
        "Technology industry", "Construction industry", "Real estate industry",
        "Public utilities industry", "Defense industry", "Arms industry", "Education industry",
        "Energy industry", "Electrical power industry", "Petroleum industry", "Entertainment industry",
        "Financial services industry", "Insurance industry", "Food industry", "Fruit production", "Health care industry",
        "Hospitality industry","Information industry", "Manufacturing","Electronics industry", "Pulp and paper industry",
        "Steel industry", "Shipbuilding industry", "Mass Media Broadcasting", "Film industry", "Music industry", "News media", "Publishing",
        "World Wide Web", "Mining", "Telecommunications industry", "Transport industry", "Water industry","Other"];
        if (($handle = fopen($fileDir, 'r')) !== false) {
            $header = fgetcsv($handle);
            while (($data = fgetcsv($handle)) !== false) {
                Job::create([
              'job_title' =>  $data[0],
              'job_description' => $data[1] ,
              'category' =>$data[2],
              'skills' => $data[3] ,
              'industry' => $industriesRandom[array_rand($industriesRandom)],
              'years_experience' => !empty($data[5])|| $data[5] == -1 ? $data[5]:0,
              'company_id' => rand($minId, $maxId)
            ]);
                unset($data);
            }
            fclose($handle);
        }
        echo 'Total memory usage : '. (memory_get_usage() - $begin);
    }

    public function array_flatten($array)
    {
        if (!is_array($array)) {
            return false;
        }
        $result = array();
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $result = array_merge($result, array_flatten($value));
            } else {
                $result[$key] = $value;
            }
        }
        return $result;
    }

    #skill words
    public function extract_keywords($text)
    {
        // Replace all non-word chars with comma
        $pattern = '/[0-9\W]/';
        $text = preg_replace($pattern, ',', $text);
        // Create an array from $text
        $text_array = explode(",", $text);
        // remove whitespace and lowercase words in $text
        $text_array = array_map('trim', $text_array);
        $text_array =  array_filter(array_map('strtolower', $text_array));
        $data = [];
        foreach ($this->skillwords as $row) {
            $containList = array_intersect($text_array, $row);
            $data[] =  array_diff($containList, $this->stanfordStopwords);
        }
        unset($text_array);
        $flattenData = array_unique(Self::array_flatten($data));
        unset($data);

        return array_values(array_filter($flattenData));
    }

    public function convertFileIntoText($fileName, $type=0)
    {
        if ($type == 1) {
            $fileDir = realpath($_SERVER["DOCUMENT_ROOT"])."/storage/".$fileName;
        } elseif ($type == 2) {
            $fileDir = storage_path() ."/app/resumes/".$fileName;
        } else {
            $fileDir = realpath($_SERVER["DOCUMENT_ROOT"])."/public/".$fileName;
        }
        $path = parse_url($fileDir, PHP_URL_PATH);
        $type = pathinfo($path, PATHINFO_EXTENSION);
        if (file_exists($fileDir)) {
            $docObj = new DocxConversion($fileDir);
            $docText = $docObj->convertToText();
            if (!$docText && $type == "pdf") {
                $parser = new Parser();
                $pdf = $parser->parseFile($fileDir);
                $text = $pdf->getText();
                return $text;
            }
            return $docText;
        } else {
            return 0;
        }
    }


    public function retrieveYearsOfExperience($desc)
    {
        $command = 'python ' . base_path() . '/app/Models/MachineLearning/GenerateDataSample.py "' . $desc . '"';
        $output = shell_exec($command);
        return $output;
    }

    //skill words
    public function readEmployeeResume($fileName, $type = 0)
    {
        $content = Self::convertFileIntoText($fileName, $type);
        $keywords = Self::extract_keywords($content);
        $minYearsExperience = trim(Self::retrieveYearsOfExperience($content));
        $keywords = array_merge($keywords, [$minYearsExperience]);
        return $keywords;
    }

    public function returnWithMaxPoints($array, $object)
    {
        $array[] = $object;
        usort($array, array(Self::class,'cmp'));
        return  array_slice($array, 0, 10);
    }

    public function cmp($a, $b)
    {
        if (array_sum($a[1]) == array_sum($b[1])) {
            return 0;
        }
        return (array_sum($a[1]) > array_sum($b[1])) ? -1 : 1;
    }

    public function potentialMaxPoints($portionArray, $pointsArray, $keywordsTotal)
    {
        $max = 0;
        for ($i = 0; $i < sizeof($portionArray); $i++) {
            if ($pointsArray[$i] != 0) {
                //100% match means that all the keywords matches on that attribute comparison
                $max += $keywordsTotal * $portionArray[$i];
            }
        }
        return $max;
    }


    public function matchPersonWithJobs($keywords, $industry = null)
    {
        //ADD ON FILTER BY JOB INDUSTRY
        // $chunks = Job::inRandomOrder()->paginate($total)->chunk(100);
        if ($industry!= null) {
            $chunks = Job::whereIndustry($industry)->get()->chunk(100);
        } else {
            $chunks = Job::all()->paginate(1000)->chunk(100);
        }
        $index = 0;
        //collect top 10 job points
        $points = [];
        foreach ($chunks as $jobs) {
            foreach ($jobs as $job) {
                //algorithm
                $job_title =  Self::extract_keywords($job->job_title);
                $job_description = Self::extract_keywords($job->job_description);
                $skills = Self::extract_keywords(preg_replace('/[0-9\W]/', ',', $job->skills));
                $years_of_exp = $job->years_experience;
                $summary = explode(",", $job->summary_keywords) ;
                foreach ($summary as $key => $value) {
                    $summary[$key] = trim($value);
                }

                $titlePortion = 0.1;
                $descPortion = 0.2;
                $skillsPortion = 0.3;
                $expPortion = 0.1;
                $summaryPortion = 0.3;

                //will same words from each factor and keywords be counted twice?
                $titlePoint = count(array_intersect($job_title, $keywords)) * $titlePortion;
                $descPoint = count(array_intersect($job_description, $keywords)) * $descPortion;
                $skillsPoint = count(array_intersect($skills, $keywords)) * $skillsPortion;
                $expPoint = ($years_of_exp <=  (int)end($keywords) ? 1 : 0) * $expPortion;
                $summaryKeywordsPoint = count(array_intersect($summary, $keywords)) * $summaryPortion;

                $maxPoint = Self::potentialMaxPoints(
                    [$titlePortion, $descPortion, $skillsPortion, $expPortion, $summaryPortion],
                    [$titlePoint, $descPoint, $skillsPoint,$expPoint, $summaryKeywordsPoint],
                    sizeof($keywords)
                );
                $accuracy = [$job->id, ($titlePoint + $descPoint + $skillsPoint + $expPoint + $summaryKeywordsPoint)/$maxPoint];
                $points = Self::returnWithMaxPoints($points, array($index,[$titlePoint,$descPoint, $skillsPoint,$expPoint, $summaryKeywordsPoint], $accuracy));
                $index++;
                unset($job);
            }
        }
        unset($chunks);
        $retrieveIndex = array_map(function ($row) {
            return $row[0];
        }, $points);

        $points = array_map(function ($row) {
            return $row[1];
        }, $points);
        $accuracy =   array_map(function ($row) {
            return $row[2];
        }, $points);

        //array of keywords match of the top 10 selection
        $keywordsMatch = [];
        $matchingJobs = Job::whereIn('id', $retrieveIndex)->get();
        foreach ($matchingJobs as $jobs) {
            $job_title =  Self::extract_keywords($jobs->job_title);
            $job_description = Self::extract_keywords($jobs->job_description);
            $skills = Self::extract_keywords(preg_replace('/[0-9\W]/', ',', $jobs->skills));
            $summary = explode(",", $jobs->summary_keywords) ;
            foreach ($summary as $key => $value) {
                $summary[$key] = trim($value);
            }

            $titlesArray = array_intersect($job_title, $keywords);
            $descArray = array_intersect($job_description, $keywords);
            $skillsArray = array_intersect($skills, $keywords);
            $summaryArray = array_intersect($summary, $keywords);

            $keywordsMatch[] = array_unique(array_merge($titlesArray, $descArray, $skillsArray, $summaryArray));
        }
        return [$matchingJobs,$points, $accuracy, $keywordsMatch, $keywords];
    }
}
