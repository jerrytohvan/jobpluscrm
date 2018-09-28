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
        return view('layouts.companies_clients', compact('array', 'score'));
    }

    public function index_companies_leads()
    {
        $array = $this->svc->getAllLeads();
        return view('layouts.companies_leads', compact('array'));
    }

    public function index_companies_new()
    {
        $message = "";
        $status = "";
        $companies = $this->svc->getAllCompany();
        return view('layouts.companies_new', compact('message', 'status', 'companies'));
    }
    public function add_new_company(Request $request)
    {
        $message = "Company successfully added!";
        $status = 1;
        $this->validate($request, [
        'company_name' => 'required',
        'address' => 'required',
        'company_email' => 'required',
        'telephone' => 'required'
      ]);
        $company = $this->svc->addCompany($request);
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
        $this->validate(request(), [
        'name' => 'required',
        'title' => 'required',
        'email' => 'required',
        'gender' => 'required',
        'handphone' => 'required',
        'resume' => 'required',
        'birthdate' => 'required',
      ]);
        $resume = request()->file('resume');
        if ($resume!=null) {
            $candidate = $this->canSvc->addCandidateFile(request()->all());
            if ($candidate != null) {
                $message = "Candidate successfully added!";
                $status = 1;
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

    public function removeAccount($employee_id)
    {
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
        $collaborators = $company->collaborators;
        $collaboratorsId = $collaborators->pluck('id')->toArray();
        $users = User::all();
        $notes = $company->posts;
        return  view('layouts.company_view', compact('company', 'accounts', 'message', 'status', 'companyFiles', 'activities', 'collaborators', 'users', 'collaboratorsId', 'notes'));
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
        $message = "Failed to add updated!";
        $status = 0;
        if ($this->svc->leadToClient($company)) {
            $message = "Company successfully converted as a client!";
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
            $message = "Opps! File can't be removed!";
        }
        //try using ajax and auto refresh page
        return redirect()->back()->with(['message' => $message, 'status' => $status]);
    }

    public function removeCompany($company_id)
    {
        $company = Company::where('id', $company_id)->first();
        $employee = Employee::where('company_id', $company_id);
        // $employee ->delete();
        // $company->delete();
        $message = "Opps! Company can't be deleted!";
        $status = 0;
        if ($employee->delete() && $company->delete()) {
            $message = "Company's profile successfully removed!";
            $status = 1;
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
        $message = "Opps! User can't be removed. ";
        $status = 0;
        if ($this->userSvc->detachUserFromCompany($user, $company) ==1) {
            $message = "User successfully removed.";
            $status = 1;
        }
        return redirect()->back()->with(['message' => $message, 'status' => $status]);
    }

    public function filterByIndustry(Request $request) {
        $industry = $request->input('industry');
        if ($industry == "All") {
            $array = Company::whereClient(1)->orderBy('name', 'asc')->get();
        } else {
            $array = Company::where('industry', $industry)->get();
        }
        return view('layouts.companies_clients', compact('array'));
    }
}
