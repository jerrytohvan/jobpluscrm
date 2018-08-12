<?php

namespace App\Models\MachineLearning;

use Illuminate\Http\Request;
use Phpml\Association\Apriori;

class MLService
{
  public function dataConstruct()
  {
    // 1. Read CSV File
    // 2. turn into array collection
    // 3. loop everything
    // 4. each row perform cleaning and keywords
    // 5. train ML based on array
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
