<?php

namespace App\Models\Jobs;

use App\Http\Controllers\Controller;
use App\Models\Clients\Company;
use App\Models\Jobs\JobService;
use Illuminate\Support\Facades\Auth;
use App\Models\Users\UserCompany;
use App\Models\Tasks\Task;
use Illuminate\Support\Facades\Validator;

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
        if (Auth::user()->admin == true) {
            $jobs = Job::all();
            $companies = Company::all()->sortBy('name');
        } else {
            $userCompanies = UserCompany::where('user_id', Auth::user()->id)->pluck('company_id')->toArray();
            $taskIds = Task::where('assigned_id', Auth::user()->id)->pluck('company_id')->toArray();
            $companiesId = Company::where('user_id', Auth::user()->id)->pluck('id')->toArray();
            $mergedIds = array_merge($userCompanies, $companiesId, $taskIds);
            $companies = Company::whereIn('id', $mergedIds)->orWhere('user_id', Auth::user()->id)->orderBy('name', 'asc')->get();
            $jobs = Job::whereIn('company_id', $mergedIds)->get();
        }
        return view('layouts.job_index', compact('jobs', 'message', 'status', 'companies'));
    }

    public function add_jobs()
    {
        $message = "Job successfully added";
        $status = 1;
        if (Auth::user()->admin == true) {
            $companies = Company::all()->sortBy('name');
            $job = $this->svc->addJob(request()->all());
            if ($job == null) {
                $message = "Failed to add job";
                $status = 0;
            }
            return view('layouts.job_new', compact('status', 'message', 'companies'));
        } else {
            $taskIds = Task::where('assigned_id', Auth::user()->id)->pluck('company_id')->toArray();
            $userCompanies = UserCompany::where('user_id', Auth::user()->id)->pluck('company_id')->toArray();
            $mergedIds = array_merge($userCompanies, $taskIds);
            $companies = Company::whereIn('id', $mergedIds)->orWhere('user_id', Auth::user()->id)->orderBy('name', 'asc')->get();
            $job = $this->svc->addJob(request()->all());
            if ($job == null) {
                $message = "Failed to add job";
                $status = 0;
            }
            return view('layouts.job_new', compact('status', 'message', 'companies'));
        }
    }

    public function index_job_new()
    {
        $message = "";
        $status = "";
        if (Auth::user()->admin == true) {
            $companies = Company::all()->sortBy('name');
            return view('layouts.job_new', compact('status', 'message', 'companies'));
        } else {
            $userCompanies = UserCompany::where('user_id', Auth::user()->id)->pluck('company_id')->toArray();
            $taskIds = Task::where('assigned_id', Auth::user()->id)->pluck('company_id')->toArray();
            $mergedIds = array_merge($userCompanies, $taskIds);
            $companies = Company::whereIn('id', $mergedIds)->orWhere('user_id', Auth::user()->id)->orderBy('name', 'asc')->get();
            return view('layouts.job_new', compact('status', 'message', 'companies'));
        }
    }

    public function update_job()
    {
        $requestArray = request()->all();
        $validator = Validator::make($requestArray, [
            'job_title' => 'required',
            'job_description' => 'required',
            'skills' => 'required',
            'industry' => 'required',
            'company_id' => 'required',
            'summary_keywords' => 'required',
        ]);

        $jobId = $requestArray['job_id'];
        unset($requestArray['job_id']);
        unset($requestArray['_token']);
        $message = "Job successfully updated!";
        $status = 1;
        $job = $this->svc->updateJob(Job::find($jobId), $requestArray);

        if ($job == null) {
            $message = "Failed to add updated!";
            $status = 0;
        }
        return redirect()->back()->with(['message' => $message, 'status' => $status]);
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
