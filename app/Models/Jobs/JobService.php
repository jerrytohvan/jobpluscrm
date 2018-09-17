<?php

namespace App\Models\Jobs;

use App\Models\Jobs\Job;
use Illuminate\Http\Request;

class JobService
{
    public function addJob($array)
    {
        return Job::create([
      'job_title' => $array['job_title'],
      'job_description' => $array['job_description'],
      'category' => "",
      'skills' => $array['job_skills'],
      'industry' => $array['industry'],
      'years_experience' => $array['years_of_experience'],
      'summary_keywords' => $array['keywords'],
      'company_id' => $array['company']
      ]);
    }
}