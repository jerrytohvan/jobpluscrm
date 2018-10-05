<?php

namespace App\Models\Clients;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Users\User;
use App\Models\Clients\Company;
use App\Models\Employees\Employee;
use App\Models\Clients\CompanyService;
use App\Models\Attachments\Attachment;
use Illuminate\Support\Facades\Auth;
use App\Models\Clients\ClientService;
use App\Models\Users\UserService;
use App\Models\ActivityLog\ActivityLogService;
use App\Models\Clients\CandidateService;
use App\Models\Jobs\Job;
use App\Models\Comments\Comment;
use App\Models\Posts\Post;
use App\Models\Tasks\Task;

class ClientController extends Controller
{
    public function __construct(UserService $userSvc, ClientService $clientSvc, CompanyService $compService, ActivityLogService $actService, CandidateService $canSvc)
    {
        $this->svc = $clientSvc;
        $this->compSvc = $compService;
        $this->actSvc = $actService;
        $this->userSvc = $userSvc;
        $this->canSvc = $canSvc;
    }
    public function index_candidates_full_list()
    {
        $message = "";
        $status = "";
        $candidates = $this->canSvc->getAllCandidates();
        return view('layouts.candidates_fulllist', compact('message', 'status', 'candidates'));
    }

    public function index_candidates_new()
    {
        $companies = $this->svc->getAllCompany();
        $message = "";
        $status = "";
        return view('layouts.candidates_new', compact('message', 'status', 'companies'));
    }
    public function public_add_candidate()
    {
        $companies = $this->svc->getAllCompany();
        $message = "";
        $status = "";
        return view('layouts.public_add_candidate', compact('message', 'status', 'companies'));
    }

    public function index_companies_clients()
    {
        $array = $this->svc->getAllClients();
        $score = $this->svc->getUrgencyScore($array);
        return view('layouts.companies_clients', compact('array', 'status', 'companies', 'score'));
    }

    public function index_companies_leads()
    {
        $message = "";
        $status = "";
        $array = $this->svc->getAllLeads();
        return view('layouts.companies_leads', compact('array', 'status', 'message'));
    }

    public function index_companies_new()
    {
        $message = "";
        $status = "";
        $companies = $this->svc->getAllCompany();
        return view('layouts.companies_new', compact('message', 'status', 'companies'));
    }
    public function add_new_company()
    {
        $message = "Company successfully added!";
        $status = 1;
        $company = $this->svc->addCompany(request()->all());
        if ($company == null) {
            $message = "Failed to add company!";
            $status = 0;
        }
        return view('layouts.companies_new', compact('status', 'message'));
    }

    public function add_new_candidate()
    {
        $message = "Failed to add candidate!";
        $status = 0;
        $resume = request()->file('resume');
        if ($resume!=null) {
            $candidate = $this->canSvc->addCandidateFile(request()->all());
            if ($candidate != null) {
                if (!empty(request()->input('type'))) {
                    $message = "Your application was successfully received! We'll get back to you with any matching jobs available soon!";
                    $status = 1;
                } else {
                    $message = "Candidate successfully added!";
                    $status = 1;
                }
            }
        }
        return redirect()->back()->with(['message' => $message, 'status' => $status]);
    }

    public function add_new_account()
    {
        $message = "Failed to add candidate!";
        $status = 0;
        $this->validate(request(), [
        'name' => 'required',
        'title' => 'required',
        'email' => 'required'
      ]);

        if ($this->svc->addAccount(request()->all())) {
            $message = "Account successfully added!";
            $status = 1;
        }
        return redirect()->back()->with(['message' => $message, 'status' => $status]);
    }
    public function removeCandidate(Candidate $candidate)
    {
        $id = $candidate->id;
        $message = "Failed to remove candidate!";
        $status = 0;
        $this->canSvc->destroyCandidate($candidate);
        if (Candidate::find($id)==null) {
            $message = "Candidate successfully removed!";
            $status = 1;
        }
        return redirect()->back()->with(['message' => $message, 'status' => $status]);
    }

    public function updateAccount()
    {
        $requestArray =  request()->all();
        $employeeId = $requestArray['employee_id'];
        unset($requestArray['employee_id']);
        unset($requestArray['_token']);
        $employee =  $this->svc->updateAccountProfile(Employee::find($employeeId), $requestArray);
        if ($employee == null) {
            $message = "Failed to update account!";
            $status = 0;
        } else {
            $message = "Account successfully updated!";
            $status = 1;
        }
        return redirect()->back()->with(['message' => $message, 'status' => $status]);
    }

    public function removeAccount(Request $request)
    {
        $requestArray = request()->all();
        $employee_id = $requestArray['contact_id'];
        $employee = Employee::find($employee_id);
        if ($employee ->delete()) {
            $message = "Employee successfully removed!";
            $status = 1;
        } else {
            $message = "Failed to remove account!";
            $status = 0;
        }
        return redirect()->back()->with(['message' => $message, 'status' => $status]);
    }

    public function showCompany(Company $company)
    {
        $message = request()->input('message');
        $status = request()->input('status');

        $accounts = $company->employees;
        $companyFiles = $company->files;
        $activities =   $this->actSvc->getActivitiesByCompany($company);
        // dd($activities);
        $collaborators = $company->collaborators;
        $collaboratorsId = $collaborators->pluck('id')->toArray();
        $users = User::all();
        $notes = $company->posts;
        $jobs = Job::whereCompanyId($company->id)->take(20)->get();


        $tasks = Task::orderBy('order')->whereCompanyId($company->id)->get();

        $tasksOpen = $tasks->map(function ($value, $key) {
            $value['company'] = Company::find($value['company_id'])->name;
            $value['assignee'] = !empty($value['assigned_id']) ? User::find($value['assigned_id'])->name : "";
            $dateNow =  date_create(date("Y-m-d H:i:s"));
            $dateAfter =  date_create(date($value['date_reminder']));
            $dateDiff = date_diff($dateNow, $dateAfter);
            $dateString = Self::constructStringFromDateTime($dateDiff);
            $value['date_string'] = $dateString;
            return $value;
        })->filter(function ($task, $key) {
            return $task->status == 0;
        })->values();

        $tasksOnGoing = $tasks->map(function ($value, $key) {
            $value['company'] = Company::find($value['company_id'])->name;
            $value['assignee'] = !empty($value['assigned_id']) ? User::find($value['assigned_id'])->name  : "";
            $dateNow =  date_create(date("Y-m-d H:i:s"));
            $dateAfter =  date_create(date($value['date_reminder']));
            $dateDiff = date_diff($dateNow, $dateAfter);
            $dateString = Self::constructStringFromDateTime($dateDiff);
            $value['date_string'] = $dateString;
            return $value;
        })->filter(function ($task, $key) {
            return $task->status == 1;
        })->values();

        $tasksClosed = $tasks->map(function ($value, $key) {
            $value['company'] = Company::find($value['company_id'])->name;
            $value['assignee'] =!empty($value['assigned_id']) ? User::find($value['assigned_id'])->name  : "";
            $dateNow =  date_create(date("Y-m-d H:i:s"));
            $dateAfter =  date_create(date($value['date_reminder']));
            $dateDiff = date_diff($dateNow, $dateAfter);
            $dateString = Self::constructStringFromDateTime($dateDiff);
            $value['date_string'] = $dateString;
            return $value;
        })->filter(function ($task, $key) {
            return $task->status == 2;
        })->values();

        return  view('layouts.company_view', compact('company', 'accounts', 'message', 'status', 'companyFiles', 'activities', 'collaborators', 'users', 'collaboratorsId', 'notes', 'jobs', 'tasksOpen', 'tasksOnGoing', 'tasksClosed'));
    }
    public function showCompanyPost(Company $company, $message=null, $status=null)
    {
        $accounts = $company->employees;
        $companyFiles = $company->files;
        return  view('layouts.company_view', compact('company', 'accounts', 'message', 'status', 'companyFiles'));
    }
    public function addNote(Company $company)
    {
        $post = $this->svc->addPost($company, request()->input('body'));
        $message = $post != null ? 'Note successfully added!': 'There was an error';
        $status = $post != null ? 1 : 0;
        return redirect()->back()->with(['message' => $message, 'status' => $status]);
    }

    public function updateCompany()
    {
        $requestArray =  request()->all();
        $companyId = $requestArray['company_id'];
        unset($requestArray['company_id']);
        unset($requestArray['_token']);

        $message = "Company successfully updated!";
        $status = 1;
        $company = $this->svc->updateCompanyProfile(Company::find($companyId), $requestArray);

        if ($company == null) {
            $message = "Failed to add updated!";
            $status = 0;
        }
        return redirect()->back()->with(['message' => $message, 'status' => $status]);
    }

    public function convertToClient(Company $company)
    {
        $message =  "Failed to update " . $company->name ." as client!";
        $status = 0;
        if ($this->svc->leadToClient($company)) {
            $message = $company->name . " company is successfully moved to client!";
            $status = 1;
        }
        return redirect()->back()->with(['message' => $message, 'status' => $status]);
    }

    public function addFileToCompany()
    {
        $file = request()->file('file_upload');
        if ($file != null) {
            $path = storage_path()."/app/attachments";
            $original_name = $file->getClientOriginalName();
            $ext = pathinfo($original_name, PATHINFO_EXTENSION);
            $company =  Company::find(request()->input('company_id'));
            //add image & file compressor
            $hashed_name = md5($original_name. time()) . "." . $ext;
            $file->move($path, $hashed_name);
            $storedFile = $this->compSvc->addCompanyFiles($hashed_name, $original_name, $company);
            if ($storedFile != null) {
                $status = 1;
                $message = "File is successfully added!";
                $accounts = $company->employees;
                $companyFiles = $company->files;
                return redirect()->back()->with(['message' => $message, 'status' => $status]);
            }
        }
        $status = 0;
        $message = "Failed to add file";
        return redirect()->back()->with(['message' => $message, 'status' => $status]);
    }

    public function getFile(Attachment $file)
    {
        if (Auth::user()) {
            return response()->download(storage_path() . "/app/attachments/" . $file->hashed_name, $file->file_name);
        }
    }

    public function getResume(Attachment $file)
    {
        if (Auth::user()) {
            return response()->download(storage_path() . "/app/resumes/" . $file->hashed_name, $file->file_name);
        }
    }

    public function removeFileFromCompany(Attachment $file)
    {
        $company = $file->attachable;
        $status = $this->compSvc->removeFile($file);
        if ($status) {
            $message = "File successfully removed!";
        } else {
            $message = "Oops! File can't be removed!";
        }
        //try using ajax and auto refresh page
        return redirect()->back()->with(['message' => $message, 'status' => $status]);
    }

    public function removeCompany(Request $request)
    {
        $requestArray = request()->all();
        $company_id = $requestArray['company_id'];
        $company = Company::where('id', $company_id)->first();
        $employee = Employee::where('company_id', $company_id);
        try {
            $employee ->delete();
            $company->delete();
            $message = "Company's profile successfully removed!";
            $status = 1;
        } catch (Exception $e) {
            $message = "Oops! Company can't be deleted!";
            $status = 0;
        }
        return redirect()->back()->with(['message' => $message, 'status' => $status]);
    }

    public function attachToCompany()
    {
        $company = Company::find(request()->input('company_id'));
        $user = User::find(request()->input('user_id'));
        $message = "Opps! User can't be added. ";
        $status = 0;
        if ($this->userSvc->attachUserWithCompany($user, $company)==1) {
            $message = "User successfully tagged.";
            $status = 1;
        }
        return redirect()->back()->with(['message' => $message, 'status' => $status]);
    }

    public function detachFromCompany(Company $company, User $user)
    {
        $message = "Opps! User can't be removed";
        $status = 0;
        if ($this->userSvc->detachUserFromCompany($user, $company) ==1) {
            $message = "User successfully removed";
            $status = 1;
        }
        return redirect()->back()->with(['message' => $message, 'status' => $status]);
    }

    public function removeNote(Request $request)
    {
        $message = "Opps! Note can't be deleted. ";
        $status = 0;

        $requestArray = request()->all();
        $postId = $requestArray['postId'];
        $post = Post::where('id',$postId)->first();

        if (Auth::user() != $post->user) {
            $message = "You are not authorised for this";
            $status = 0;
            return redirect()->back()->with(['message' => $message, 'status' => $status]);
        }
        $comment = $post->comment()->delete();
        $post->delete();
        $message = "Note successfully deleted";
        $status = 1;
        return redirect()->back()->with(['message' => $message, 'status' => $status]);
    }

    public function editNote(Request $request)
    {
        $this->validate($request, [
          'content' => 'required'
      ]);
        $post = Post::find($request->id);
        if (Auth::user() != $post->user) {
            return redirect()->back();
        }
        $post->content = $request['content'];
        $post->update();
        return response()->json(['updated_content' => $post->content], 200);
    }

    public function constructStringFromDateTime($date)
    {
        if ($date->invert) {
            return "Pass due date";
        }
        $string = "Due in ";
        if ($date->y != "0") {
            $string .= $date->y;
            if ($date->y == '1') {
                $string .= " year";
            } else {
                $string .= " years";
            }
        } elseif ($date->m != '0') {
            $string .= $date->m;
            if ($date->m == '1') {
                $string .= " month";
            } else {
                $string .= " months";
            }
        } elseif ($date->d != '0') {
            $string .= $date->d;
            if ($date->d == '1') {
                $string .= " day";
            } else {
                $string .= " days";
            }
        } elseif ($date->h != '0') {
            $string .= $date->h;
            if ($date->h == '1') {
                $string .= " day";
            } else {
                $string .= " days";
            }
        } elseif ($date->i != '0') {
            $string .= $date->i;
            if ($date->i == '1') {
                $string .= " minute";
            } else {
                $string .= " minutes";
            }
        } elseif ($date->s != '0') {
            $string .= $date->s;
            if ($date->s == '1') {
                $string .= " second";
            } else {
                $string .= " seconds";
            }
        }
        return $string;
    }
    // public function filterByIndustry(Request $request)
    // {
    //     $industry = $request->input('industry');
    //     if ($industry == "All") {
    //         $array = Company::whereClient(1)->orderBy('name', 'asc')->get();
    //     } else {
    //         $array = Company::where('industry', $industry)->get();
    //     }
    //     $score = $this->svc->getUrgencyScore($array);
    //     return view('layouts.companies_clients', compact('array', 'score'));
    // }
}
