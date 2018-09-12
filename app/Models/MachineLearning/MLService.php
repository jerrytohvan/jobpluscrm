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

use Smalot\PdfParser\Parser;

class MLService
{
    public function __construct()
    {
        $this->api = new TextRankFacade();

        $stopWords = new English();
        $this->api->setStopWords($stopWords);

        $this->stopwords =  file(public_path('/stop_words.txt'));

        // Remove line breaks and spaces from stopwords
        $this->stopwords = array_map(function ($x) {
            return trim(strtolower($x));
        }, $this->stopwords);
    }

    public function setDataIntoDB($fileDir)
    {
        $begin = memory_get_usage();

        // $container = new Collection();
        if (($handle = fopen($fileDir, 'r')) !== false) {
            $header = fgetcsv($handle);
            while (($data = fgetcsv($handle)) !== false) {
                Job::create([
              'job_title' =>  $data[0],
              'job_description' => $data[1] ,
              'category' =>$data[2],
              'skills' => $data[3] ,
              'industry' => $data[4],
              'years_experience' => !empty($data[5])|| $data[5] == -1 ? $data[5]:0,
            ]);
                unset($data);
            }
            fclose($handle);
        }
        echo 'Total memory usage : '. (memory_get_usage() - $begin);

        // return Job::all();
    }

    public function extract_keywords($text)
    {
        // Replace all non-word chars with comma
        $pattern = '/[0-9\W]/';
        $text = preg_replace($pattern, ',', $text);
        // Create an array from $text
        $text_array = explode(",", $text);
        // remove whitespace and lowercase words in $text
        $text_array = array_map('trim', $text_array);
        $text_array =  array_map('strtolower', $text_array);

        $data = array_diff($text_array, $this->stopwords);
        unset($text_array);
        return array_values(array_filter($data));
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


    public function matchPersonWithJobs($keywords)
    {
        $chunks = Job::all()->sortBy('id')->take(20000)->chunk(100);
        $index = 0;
        //collect top 10 job points
        $points = [];

        foreach ($chunks as $jobs) {
            foreach ($jobs as $job) {
                $job_title =  Self::extract_keywords($job->job_title);
                $job_description = Self::extract_keywords($job->job_description);
                $skills = Self::extract_keywords(preg_replace('/[0-9\W]/', ',', $job->skills));
                $years_of_exp = $job->years_experience;
                $titlePoint = count(array_intersect($job_title, $keywords));
                $descPoint = count(array_intersect($job_description, $keywords));
                $skillsPoint = count(array_intersect($skills, $keywords));
                $expPoint = $years_of_exp <=  (int)end($keywords) ? 1 : 0;
                $points = Self::returnWithMaxPoints($points, array($index,[$titlePoint,$descPoint, $skillsPoint,$expPoint]));
                $index++;
            }
        }

        $retrieveIndex = array_map(function ($row) {
            return $row[0];
        }, $points);

        $points = array_map(function ($row) {
            return $row[1];
        }, $points);

        return [Job::whereIn('id', $retrieveIndex)->get(),$points];
    }
}
