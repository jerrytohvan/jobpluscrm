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
use Illuminate\Contracts\Filesystem\Filesystem;
use  App\Models\Attachments\AttachmentService;
use Smalot\PdfParser\Parser;

class MLService
{
    public function __construct(AttachmentService $attachSvc)
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

        $this->s3 = Storage::disk('s3');
        $this->url = 'https://s3.' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') ;
        $this->attachSvc = $attachSvc;
    }

    public function setDataIntoDB($fileDir)
    {
        $begin = memory_get_usage();
        $maxId = Company::max('id');
        $minId = Company::min('id');
        $industriesRandom =   [
          "Accounting / Audit / Tax Services",
          "Advertising / Marketing / Promotion / PR",
        "Aerospace / Aviation / Airline",
        "Agricultural / Plantation / Poultry / Fisheries",
        "Apparel",
        "Architectural Services / Interior Designing",
        "Arts / Design / Fashion",
        "Automobile / Automotive Ancillary / Vehicle",
        "Banking / Financial Services",
        "BioTechnology / Pharmaceutical / Clinical research",
        "Call Center / IT-Enabled Services / BPO",
        "Chemical / Fertilizers / Pesticides",
        "Computer / Information Technology (Hardware)",
         "Computer / Information Technology (Software)",
          "Construction / Building / Engineering",
          "Consulting (Business & Management)",
        "Consulting (IT, Science, Engineering & Technical)",
         "Consumer Products / FMCG",
          "Education",
           "Electrical & Electronics",
        "Entertainment / Media",
        "Environment / Health / Safety",
         "Exhibitions / Event management / MICE",
         "Food & Beverage / Catering / Restaurant",
          "Gems / Jewellery",
        "General & Wholesale Trading",
        "Government / Defence",
         "Grooming / Beauty / Fitness",
         "Healthcare / Medical",
          "Heavy Industrial / Machinery / Equipment",
        "Hotel / Hospitality",
        "Human Resources Management / Consulting",
         "Insurance",
         "Journalism",
          "Law / Legal",
           "Library / Museum",
            "Manufacturing / Production",
        "Marine / Aquaculture",
         "Mining",
          "Non-Profit Organisation / Social Services / NGO",
           "Oil / Gas / Petroleum",
           "Polymer / Plastic / Rubber / Tyres",
          "Printing / Publishing",
          "Property / Real Estate",
          "R&D",
          "Repair & Maintenance Services",
          "Retail / Merchandise",
          "Science & Technology",
          "Security / Law Enforcement",
          "Semiconductor / Wafer Fabrication",
          "Sports",
          "Stockbroking / Securities",
          "Telecommunication",
          "Textiles / Garmen",
          "Tobacco",
          "Transportation / Logistics",
          "Travel / Tourism",
          "Utilities / Power",
          "Wood / Fibre / Paper",
           "Other"];
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
            $fileDir = $this->url . '/resume/' . $fileName;
        } else {
            $fileDir = realpath($_SERVER["DOCUMENT_ROOT"])."/public/".$fileName;
        }
        $path = parse_url($fileDir, PHP_URL_PATH);
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $exists = Storage::disk('s3')->exists('/resume/'. $fileName);
        if ($exists) {
            $file = fopen($fileDir, 'r');
            $docObj = new DocxConversion($fileDir, $fileName, $type);
            $docText = $docObj->convertToText();
            if ($type == "pdf" && !$docText) {
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
        if ($a[3] == $b[3]) {
            return 0;
        }
        return ($a[3] > $b[3]) ? -1 : 1;
    }

    public function matchPersonWithJobs($keywords, $industry = null)
    {
        //ADD ON FILTER BY JOB INDUSTRY
        if ($industry!= null) {
            $chunks = Job::where('industry', '=', $industry)->orderBy('id', 'asc')->get()->chunk(100);
        } else {
            $chunks = Job::all()->chunk(100);
        }

        //collect top 10 job points
        $points = [];
        $keywordSize = count($keywords);
        foreach ($chunks as $jobs) {
            foreach ($jobs as $job) {
                //algorithm
                $job_title =  Self::extract_keywords($job->job_title);
                $job_description = Self::extract_keywords(strip_tags($job->job_description));
                $skills = Self::extract_keywords(preg_replace('/[0-9\W]/', ',', strip_tags($job->skills)));
                $years_of_exp = $job->years_experience;
                $summary = explode(",", $job->summary_keywords);
                foreach ($summary as $key => $value) {
                    $summary[$key] = trim($value);
                }

                $keywordsMatched = array_intersect($keywords, array_unique(array_merge($job_title, $job_description, $skills, $summary)));
                $accuracy =  count($keywordsMatched)/$keywordSize * 100;
                $points = Self::returnWithMaxPoints($points, array($job->id, $accuracy,$keywordsMatched,count($keywordsMatched)));
            }
        }


        $retrieveIndex = array_map(function ($row) {
            return $row[0];
        }, $points);

        $accuracy =   array_map(function ($row) {
            return $row[1];
        }, $points);

        $points = array_map(function ($row) {
            return $row[3];
        }, $points);

        //array of keywords match of the top 10 selection
        $keywordsMatch = [];
        $matchingJobs= [];
        // $matchingJobs = Job::whereIn('id', $retrieveIndex)->get();

        foreach ($retrieveIndex as $id) {
            $matchingJobs[] = Job::find($id);
        }

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
