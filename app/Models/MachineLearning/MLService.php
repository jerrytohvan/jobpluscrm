<?php

namespace App\Models\MachineLearning;

use Illuminate\Http\Request;
use Phpml\Association\Apriori;
use Illuminate\Support\Collection;
// use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\MachineLearning\StoreSampleData;

class MLService
{

  public function __construct(){
    $this->stopwords =  file(storage_path('app/stop_words.txt'));
    // Remove line breaks and spaces from stopwords
    $this->stopwords = array_map(function($x){
      yield trim(strtolower($x));
    }, $this->stopwords);
  }

    public function setDataIntoDB($fileDir){
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

          // $contain =  $container->chunk(100, function ($container) {
          //   foreach($container as $data){
          //     dd('ok');
          //     // StoreSampleData::create(
          //     //   [
          //     //     'job_title' => !empty($data[0]) ? $data[0]:'-',
          //     //     'job_description' => !empty($data[1]) ? json_encode(Self::extract_keywords($data[1])):'-',
          //     //     'category' => !empty($data[2]) ? $data[2]:'-',
          //     //     'skills' => !empty($data[3]) ? $data[3]:'-',
          //     //     'industry' => !empty($data[4]) ? $data[4]:'-',
          //     //     'prefered_years_experience' => !empty($data[5]) ? $data[5]:'-',
          //     //   ]
          //     // );
          //   }
          //   });
            // dd($contain[0]->toArray());

        }
        $allData =StoreSampleData::all();
        StoreSampleData::chunk(100, function ($allData) {
              foreach ($allData as $data) {
                  $data->update(['job_description' => serialize(Self::extract_keywords($data->job_description))]);
              }
          });

          var_dump($allData);
      dd( StoreSampleData::all());
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
    $textCollection = collect($text_array);
    $textCollection = $textCollection->filter(function ($word, $key) {
          if(!in_array($word, $this->stopwords)){
            return true;
          };
    });

    //Strpos way?
    //array_diff($strarray, $stopwords);
    return array_filter($textCollection->all());
}

  public function constructData($fileDir)
  {
    # format: job_title, job_description, category, skills/requirement, industry, prefered_years_experience,

    // 1. Read CSV File
    // 2. turn into array collection
    // 3. loop everything
    // 4. each row perform cleaning and keywords
    // 5. train ML based on array

    //word frequency, density and prominence?
    // $collection = [];
    // $collection = new Collection();
    // $handle = fopen($fileDir, "r");
    // $header = true;
    // while ($csvLine = fgetcsv($handle, ",")) {
    //   if ($header) {
    //       $header = false;
    //   } else {
    //     //using json
    //     $collection->push(
    //       json_encode([
    //         'job_title' => !empty($csvLine[0]) ? $csvLine[0]:'-',
    //         'job_description' => !empty($csvLine[1]) ? Self::extract_keywords($csvLine[1]):'-',
    //         'category' => !empty($csvLine[2]) ? $csvLine[2]:'-',
    //         'skills' => !empty($csvLine[3]) ? $csvLine[3]:'-',
    //         'industry' => !empty($csvLine[4]) ? $csvLine[4]:'-',
    //         'prefered_years_experience' => !empty($csvLine[5]) ? $csvLine[5]:'-',
    //       ])
    //     );
    //   }
    //   unset($csvLine);
    // }
    // fclose($handle);
    // dd($collection);

    // $jobTitleKeywords =  $collection->map(function ($row, $key) {
    //   return Self::extract_keywords($row['job_title']);
    // });

    // $jobDescriptionKeywords =  $collection->map(function ($row, $key) {
    //   return $row['job_description'];
    // });

    $collection = StoreSampleData::all();
    // $jobDescriptionKeywords =  $collection->pluck('job_description');
//do sum
    $jobDescriptionKeywords =  $collection->map(function ($row, $key) {
          return [
            Self::extract_keywords($row['job_description'])
        ];
    });

// $jobDescriptionKeywords =  $collection->map(function ($row, $key) {
//     return [
//       'job_title' => $row['job_title'],
//     'job_description' =>   Self::extract_keywords($row['job_description']),
//     'category' =>   $row['category'],
//       'skills' => $row['skills'],
//       'industry' => $row['industry'],
//       'prefered_years_experience' => $row['prefered_years_experience'],
//   ];
// });


    dd($jobDescriptionKeywords->all());

}

  public function findEmployeesByJobDesc(){
    //Revese function for partners to try out and apply for request
  }

public function convertFileIntoText(){
  #UI will be a wizard kind, predefined steps.
  #pdf or word? -> add as
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
    $associator = new Apriori($support = 0.5, $confidence = 0.5);
    $samples = [['alpha', 'beta', 'epsilon'], ['alpha', 'beta', 'theta'], ['alpha', 'beta', 'epsilon'], ['alpha', 'beta', 'theta']];
    $labels  = [];
    $associator->train($samples, $labels);
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
