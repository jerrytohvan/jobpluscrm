<?php

namespace App\Models\MachineLearning;

use Illuminate\Http\Request;
use Phpml\Association\Apriori;
use Illuminate\Support\Collection;
// use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\MachineLearning\StoreSampleData;
use PhpScience\TextRank\Tool\StopWords\English;
use PhpScience\TextRank\TextRankFacade;
use App\Models\DocxConversion;
use Smalot\PdfParser\Parser;

class MLService
{

  public function __construct(){
    $this->associator = new Apriori($support = 0.2, $confidence = 0.2);
    $this->stopwords =  file(storage_path('app/stop_words.txt'));
    // Remove line breaks and spaces from stopwords
    $this->stopwords = array_map(function($x){
      return trim(strtolower($x));
    }, $this->stopwords);
  }

    public function setDataIntoDB($fileDir){
      $begin = memory_get_usage();

      // $container = new Collection();
      if(($handle = fopen($fileDir, 'r')) !== false){
            $header = fgetcsv($handle);
            while(($data = fgetcsv($handle)) !== false)
            {
              StoreSampleData::create([
                'job_title' => !empty($data[0]) ? $data[0]:'-',
                'job_description' => !empty($data[1]) ? $data[1]:'-',
                'category' => !empty($data[2]) ? $data[2]:'-',
                'skills' => !empty($data[3]) ? $data[3]:'-',
                'industry' => !empty($data[4]) ? $data[4]:'-',
                'prefered_years_experience' => !empty($data[5]) ? $data[5]:'-',
              ]);
              unset($data);
            }
            fclose($handle);
        }
        $allData =StoreSampleData::all();
        StoreSampleData::chunk(100, function ($allData) {
              foreach ($allData as $data) {
                  $data->update(['job_description' => serialize(Self::extract_keywords($data->job_description))]);
                  unset($data);
              }
          });
        unset($allData);
        echo 'Total memory usage : '. (memory_get_usage() - $begin);

      return StoreSampleData::all();
    }

  public function extract_keywords($text) {
    // Replace all non-word chars with comma
    $pattern = '/[0-9\W]/';
    $text = preg_replace($pattern, ',', $text);
    // Create an array from $text
    $text_array = explode(",",$text);
    // remove whitespace and lowercase words in $text
    $text_array = array_map('trim', $text_array);
    $text_array =  array_map('strtolower', $text_array);

    $data = array_diff($text_array, $this->stopwords);
    unset($text_array);
    return array_values(array_filter($data));
    //Strpos way?
    //array_diff($strarray, $stopwords);
    // return array_filter($textCollection->all());
}

  public function constructData()
  {
    # format: job_title, job_description, category, skills/requirement, industry, prefered_years_experience,
    $begin = memory_get_usage();
   $allData = StoreSampleData::all()->pluck('job_description')->toArray();
//write to file?
$contain =[];
   foreach($allData as $data){
     $contain[] = unserialize($data);
     unset($data);
   }
   $this->associator->train($contain,[]);
   //https://phpdoc.hotexamples.com/class/phpml.association/Apriori & RAKE
   dd($this->associator->getRules());
    echo 'Total memory usage : '. (memory_get_usage() - $begin);
    return $jobDescriptionKeywords->all();
}

public function retrieveKeywordsByRake($text){
  $api = new TextRankFacade();
  // English implementation for stopwords/junk words:
  $stopWords = new English();
  $api->setStopWords($stopWords);
  $result = $api->summarizeTextBasic($text);
  dd($api->getOnlyKeyWords(array_values($result)[0]));
}




  public function findEmployeesByJobDesc(){
    //Revese function for partners to try out and apply for request
  }

public function convertFileIntoText($fileName){
  //read filetype
  // clearstatcache();
  $fileDir = realpath($_SERVER["DOCUMENT_ROOT"])."/public/".$fileName;
  $path = parse_url($fileDir, PHP_URL_PATH);
  $type = pathinfo($path, PATHINFO_EXTENSION);
  $docObj = new DocxConversion($fileDir);
  $docText = $docObj->convertToText();
  if(!$docText && $type == "pdf" ){
    $parser = new Parser();
    $pdf = $parser->parseFile($fileDir);
    $text = $pdf->getText();
    return $text;
  }

  return $docText;
  //pdf use fopen
}

public function readEmployeeEmail(){
  #generate keywords from employee's email
}


  public function readEmployeeResume(){
    #generate employeeKeywords
    #calls convert file into text
  }


  public function trainML()
  {
  }

  public function generateEmployeeKeywords(){

  }
  public function generateJobKeywords(){

  }

  public function matchJobWithEmployeeResume($query){
    #match keywords from employee resume

  }

    public function crawlJobStreet($query){
    //use keywords from ML based on user input
    //to find available jobs based on employees

  }

}
