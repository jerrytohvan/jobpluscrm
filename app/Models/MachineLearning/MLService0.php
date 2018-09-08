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

class MLService0
{
    public function __construct()
    {
        $this->associator = new Apriori($support = 0.08, $confidence = 0.08);
        $this->api = new TextRankFacade();

        $stopWords = new English();
        $this->api->setStopWords($stopWords);

        // $this->stopwords =  file(storage_path('app/stop_words.txt'));
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
                //   StoreSampleData::create([
                //   'job_title' => !empty($data[0]) ? $data[0]:'-',
                //   'job_description' => !empty($data[1]) ? $data[1] :'-',
                //   'category' => !empty($data[2]) ? $data[2]:'-',
                //   'skills' => !empty($data[3]) ? $data[3]:'-',
                //   'industry' => !empty($data[4]) ? $data[4]:'-',
                //   'prefered_years_experience' => !empty($data[5]) ? $data[5]:'-',
                // ]);
                Job::create([
              'job_title' => !empty($data[0]) ? $data[0]:'-',
              'job_description' => !empty($data[1]) ? $data[1] :'-',
              'category' => !empty($data[2]) ? $data[2]:'-',
              'skills' => !empty($data[3]) ? $data[3]:'-',
              'industry' => !empty($data[4]) ? $data[4]:'-',
              'prefered_years_experience' => !empty($data[5]) ? $data[5]:'-',
            ]);
                unset($data);
            }
            fclose($handle);
        }
        // $allData =StoreSampleData::all();
        // StoreSampleData::chunk(100, function ($allData) {
        //     foreach ($allData as $data) {
        //         $data->update([
        //             'job_description' => serialize(Self::extract_keywords(implode(",", $this->api->summarizeTextBasic($data->job_description)))),
        //             'job_title' => serialize(explode(',', preg_replace('/[0-9\W]/', ',', $data->job_title))),
        //             'skills' => serialize(Self::extract_keywords($data->skills)),
        //           ]);
        //         unset($data);
        //     }
        // });
        // unset($allData);
        echo 'Total memory usage : '. (memory_get_usage() - $begin);

        return StoreSampleData::all();
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

    public function constructData()
    {
        # format: job_title, job_description, category, skills/requirement, industry, prefered_years_experience,
        $begin = memory_get_usage();
        $allData = StoreSampleData::all()->chunk(100);
        foreach ($allData as $data) {
            $contain = [];
            foreach ($data as $row) {
                $contain = [unserialize($row->job_description)];
                unset($row);
            }
            $this->associator->train($contain, []);
            unset($contain);
        }
        unset($allData);
        dd($this->associator->getRules());

        //  $allData = StoreSampleData::all()->pluck('job_description')->toArray();
        // //write to file?
        //
        //  foreach($allData as $data){
        //    $contain[] = unserialize($data);
        //    unset($data);
        //  }
        //  $this->associator->train($contain,[]);
        //https://phpdoc.hotexamples.com/class/phpml.association/Apriori & RAKE
        dd($this->associator->getRules());
        echo 'Total memory usage : '. (memory_get_usage() - $begin);
        return $jobDescriptionKeywords->all();
    }

    public function retrieveKeywordsByRake($text)
    {
        $result = $this->api->summarizeTextBasic($text);
        dd($this->api->getOnlyKeyWords(array_values($result)[0]));
    }


    public function findEmployeesByJobDesc()
    {
        //Revese function for partners to try out and apply for request
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

    public function parseFile($fileDir, File $file = null)
    {
        // $docObj = new DocxConversion($fileDir);
        //
        // if (!$file) {
        // } else {
        //     $docText = $docObj->convertToText();
        //     if (!$docText && $type == "pdf") {
        //         $parser = new Parser();
        //         $pdf = $parser->parseFile($fileDir);
        //         $text = $pdf->getText();
        //         return $text;
        //     }
        // }
        // return $docText;
    }

    public function retrieveYearsOfExperience($desc)
    {
        $command = 'python ' . base_path() . '/app/Models/MachineLearning/GenerateDataSample.py "' . $desc . '"';
        $output = shell_exec($command);
        return $output;
    }

    public function readEmployeeEmail()
    {
        #generate keywords from employee's email
    }

    public function readEmployeeResume($fileName, $type = 0)
    {
        $content = Self::convertFileIntoText($fileName, $type);
        $keywords = Self::extract_keywords($content);
        $minYearsExperience = trim(Self::retrieveYearsOfExperience($content));
        $keywords = array_merge($keywords, [$minYearsExperience]);
        return $keywords;
    }


    //check against 2 array
    //add type to consider rules for every kind of matching
    public function similarityRate($subjectArray, $objectArray, $type = 0)
    {
        $container = [];
        if ($type == 0) {
            foreach ($objectArray as $row) {
                $score = 0 ;
                foreach ($subjectArray as $subject) {
                    if (in_array($subject, $row)) {
                        $score++;
                    }
                }
                $container[] = $score;
            }
        } else {
            foreach ($objectArray as $object) {
                if ($subjectArray != -1 && strcmp($subjectArray, $object) == 0) {
                    $container[] = 1;
                } else {
                    $container[] = 0;
                }
            }
        }
        return $container;
    }

    public function calculateTotalScore($jobTitleSkillsSimilarityCount, $jobDescSimilarityCount, $expSimilarityCount)
    {
        $containTotalScore = [];
        for ($x = 0; $x < count($jobTitleSkillsSimilarityCount); $x++) {
            $contain = [];
            for ($y = 0; $y < count($jobTitleSkillsSimilarityCount[$x]); $y++) {
                $contain[] = 0.5 * $jobTitleSkillsSimilarityCount[$x][$y] + 0.2  * $jobDescSimilarityCount[$x][$y] + 0.3 * $expSimilarityCount[$x][$y];
            }
            $containTotalScore[] = $contain;
            unset($contain);
        }
        unset($jobTitleSkillsSimilarityCount);
        unset($jobDescSimilarityCount);
        unset($expSimilarityCount);

        //loop & array merge
        foreach ($containTotalScore as $rowArray) {
            $containTotalScore = array_merge($rowArray, $containTotalScore);
        }
        //count index
        $topIndexes = [];

        $minDBIndex = StoreSampleData::min('id');
        $totalSortedDesc = array_merge([], $containTotalScore);
        rsort($totalSortedDesc);
        $topIndexes[] = $minDBIndex + array_search(max($containTotalScore), $containTotalScore);
        $topIndexes[] = $minDBIndex + array_search($totalSortedDesc[1], $containTotalScore);
        $topIndexes[] = $minDBIndex + array_search($totalSortedDesc[2], $containTotalScore);
        unset($totalSortedDesc);

        $results = [
        preg_replace('/\s+/', ' ', implode(" ", unserialize(StoreSampleData::find($topIndexes[0])->job_title))),
        preg_replace('/\s+/', ' ', implode(" ", unserialize(StoreSampleData::find($topIndexes[1])->job_title))),
        preg_replace('/\s+/', ' ', implode(" ", unserialize(StoreSampleData::find($topIndexes[2])->job_title))),
      ];
        return $results;
    }

    public function matchResumeWithSampleData($fileName, $additionalQuery=[], $type = 0)
    {
        $jobSampleData = StoreSampleData::all()->sortBy('id');

        $jobDesc = $jobSampleData->pluck('job_description')->chunk(100);

        $skillsTitle = $jobSampleData->map(function ($data) {
            $jobTitles = unserialize($data->job_title);
            $skills = unserialize($data->skills);
            return array_merge($jobTitles, $skills);
        })->chunk(100);

        $exp = $jobSampleData->pluck('prefered_years_experience')->chunk(100);
        unset($jobSampleData);

        $jobTitleSkillsSimilarityCount= [];//A
        $jobDescSimilarityCount = [];//B
        $expSimilarityCount = [];//C

        $resumeKeywords = array_merge($additionalQuery, Self::readEmployeeResume($fileName, $type));
        for ($x = 0; $x < count($skillsTitle); $x++) {
            //A
            $jobTitleSkillsSimilarityCount[] = Self::similarityRate($resumeKeywords, $skillsTitle[$x]);

            //B
            $containDescArray = [];
            foreach ($jobDesc[$x] as $data) {
                $containDescArray[] = unserialize($data);
                unset($data);
            }
            $jobDescSimilarityCount[] = Self::similarityRate($resumeKeywords, $containDescArray);
            unset($containDescArray);

            //C
            $expSimilarityCount[] = Self::similarityRate(end($resumeKeywords), $exp[$x], 1);

            unset($jobDesc[$x]);
            unset($skillsTitle[$x]);
            unset($exp[$x]);
        }

        unset($resumeKeywords);
        unset($skillsTitle);
        unset($jobDesc);
        unset($exp);

        $results = Self::calculateTotalScore($jobTitleSkillsSimilarityCount, $jobDescSimilarityCount, $expSimilarityCount);
        return $results;
    }

    public function matchPersonWithJobs($keywords)
    {
        //->chunk(100)
        $jobs = Job::all()->sortBy('id');
        $points = [];
        foreach ($jobs as $job) {
            $job_title =  Self::extract_keywords($job->job_title);
            $job_description = Self::extract_keywords($job->job_description);
            $skills = Self::extract_keywords(preg_replace('/[0-9\W]/', ',', $job->skills));
            $years_of_exp = $job->years_experience;
            //measure similarity of job title
            $titlePoint = count(array_intersect($job_title, $keywords));
            $descPoint = count(array_intersect($job_description, $keywords));
            $skillsPoint = count(array_intersect($skills, $keywords));
            $expPoint = $years_of_exp <=  (int)end($keywords) ? 1 : 0;

            $points[]  = [$titlePoint,$descPoint, $skillsPoint,$expPoint];
        }
        return $points;
    }
}
