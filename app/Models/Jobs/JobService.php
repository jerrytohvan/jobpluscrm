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
      'company_id' => $array['company'],
      'date' => date_create('now', timezone_open('Asia/Singapore'))->format('Y-m-d H:i:s')
      ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Job $job
     * @param  Array  $array
     * @return \Illuminate\Http\Response
     */
    public function updateJob($job, $array)
    {
        foreach ($array as $key => $value) {
            $job->$key = $value;
        }
        $job->save();

        return $job;
    }
}
