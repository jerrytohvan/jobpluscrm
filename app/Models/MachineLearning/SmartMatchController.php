<?php

namespace App\Models\MachineLearning;

use App\Http\Requests;
use  App\Models\MachineLearning\MLService;
use App\Http\Controllers\Controller;
use  App\Models\Clients\Candidate;
use  App\Models\Attachments\AttachmentService;

class SmartMatchController extends Controller
{
    public function __construct(MLService $mlService, AttachmentService $attachSvc)
    {
        $this->svc = $mlService;
        $this->attachSvc = $attachSvc;
        $this->middleware('auth');
    }

    public function index()
    {
        return view('layouts.index_smart_match');
    }

    public function matchCandidatesWithJobs(Candidate $candidate)
    {
        $file = $candidate->files->first();
        $keywords = $this->svc->readEmployeeResume($file->hashed_name, 2);
        if (!empty($candidate->summary_keywords)) {
            $keywords = array_merge(explode(',', $candidate->summary_keywords), $keywords);
        }
        $results = $this->svc->matchPersonWithJobs($keywords);
        return view('layouts.smart_match_ajax', compact('results'));
    }

    public function matchCandidatesWithJobsToJson()
    {
        $candidate = Candidate::find(request()->input('candidate_id'));
        $file = $candidate->files->first()->hashed_name;
        $keywords = $this->svc->readEmployeeResume($file, 2);
        if (!empty($candidate->summary_keywords)) {
            $keywords = array_merge(explode(',', $candidate->summary_keywords), $keywords);
        }
        $results = $this->svc->matchPersonWithJobs($keywords, $candidate->industry);
        return json_encode($results);
    }

    public function resultsSmartMatch(Candidate $candidate)
    {
        $file = $candidate->files->first();
        $keywords = $this->svc->readEmployeeResume($file->hashed_name, 2);
        if (!empty($candidate->summary_keywords)) {
            $keywords = array_merge(explode(',', $candidate->summary_keywords), $keywords);
        }
        return view('layouts.smart_match_ajax', compact('candidate', 'keywords'));
    }
}
