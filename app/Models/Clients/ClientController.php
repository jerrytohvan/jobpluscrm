<?php

namespace App\Models\Clients;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Clients\Company;
use App\Models\Employees\Employee;
use App\Models\Clients\CompanyService;
use App\Models\Attachments\Attachment;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function __construct(ClientService $clientSvc, CompanyService $compService)
    {
        $this->middleware('auth');

        $this->svc = $clientSvc;
        $this->compSvc = $compService;
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

    public function index_companies_full_list()
    {
        $array = $this->svc->getAllCompany();
        return view('layouts.companies_fulllist', compact('array'));
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
        return view('layouts.accounts_new', compact('status', 'message', 'companies'));
    }
    public function showCompany(Company $company)
    {
        // if ($status!=null) {
        //     return redirect()->route('view.company', compact('company'));
        // }
        $message = request()->input('message');
        $status = request()->input('status');

        $accounts = $company->employees;
        $companyFiles = $company->files;

        return  view('layouts.company_view', compact('company', 'accounts', 'message', 'status', 'companyFiles'));
    }
    public function showCompanyPost(Company $company, $message=null, $status=null)
    {
        // if ($status!=null) {
        //     return redirect()->route('view.company', compact('company'));
        // }

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
        $employee ->delete();
        $company->delete();
        return redirect()->route('companies.fulllist')->with(['message']);
    }
}
