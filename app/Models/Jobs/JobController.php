<?php

namespace App\Models\Jobs;

use App\Http\Controllers\Controller;
use  App\Models\Clients\Candidate;
use App\Models\Clients\Company;
use App\Models\Jobs\JobService;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function __construct(JobService $svc)
    {
        $this->middleware('auth');
        $this->svc = $svc;
    }
    public function index()
    {
        $message = "";
        $status = "";
        $jobs = Job::paginate(500);
        return view('layouts.job_index', compact('jobs', 'message', 'status'));
    }

    public function add_jobs()
    {
        $message = "Failed to add job";
        $status = 0;
        if ($this->svc->addJob(request()->all())) {
            $message = "Job successfully added";
            $status = 1;
        }
        return redirect()->back()->with(['message' => $message, 'status' => $status]);
    }

    public function index_job_new()
    {
        $message = "";
        $status = "";
        $companies = Company::all();
        return view('layouts.job_new', compact('status', 'message', 'companies'));
    }

    public function delete_job()
    {
        $job = Job::find(request()->input('job'));
        if ($job != null && $job->delete()) {
            $message = "Job post successfully removed!";
            $status = 1;
        } else {
            $message = "Failed to remove job post!";
            $status = 0;
        }
        return redirect()->back()->with(['message' => $message, 'status' => $status]);
    }
}
