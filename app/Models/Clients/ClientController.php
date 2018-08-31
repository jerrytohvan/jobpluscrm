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

class ClientController extends Controller
{
    public function __construct(UserService $userSvc, ClientService $clientSvc, CompanyService $compService, ActivityLogService $actService)
    {
        $this->middleware('auth');

        $this->svc = $clientSvc;
        $this->compSvc = $compService;
        $this->actSvc = $actService;
        $this->userSvc = $userSvc;
    }
    public function index_account_full_list()
    {
        $accounts = $this->svc->getAllAccount();
        return view('layouts.accounts_fulllist', compact('accounts'));
    }
    public function index_account_new()
    {
        $companies = $this->svc->getAllCompany();
        $message = "";
        $status = "";
        return view('layouts.accounts_new', compact('message', 'status', 'companies'));
    }

    public function index_companies_clients()
    {
        $array = $this->svc->getAllClients();
        return view('layouts.companies_clients', compact('array'));
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

    public function add_new_account(Request $request)
    {
        $companies = $this->svc->getAllCompany();
        $message = "Account successfully added!";
        $status = 1;
        $this->validate($request, [
        'name' => 'required',
        'email' => 'required',
        'handphone' => 'required',
        'company_id' => 'required'

      ]);
        $account = $this->svc->addAccount($request);
        if ($account == null) {
            $message = "Failed to add account!";
            $status = 0;
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
        return  view('layouts.company_view', compact('company', 'accounts', 'message', 'status', 'companyFiles', 'activities', 'collaborators', 'users', 'collaboratorsId'));
    }
    public function showCompanyPost(Company $company, $message=null, $status=null)
    {
        $accounts = $company->employees;
        $companyFiles = $company->files;
        return  view('layouts.company_view', compact('company', 'accounts', 'message', 'status', 'companyFiles'));
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
}
