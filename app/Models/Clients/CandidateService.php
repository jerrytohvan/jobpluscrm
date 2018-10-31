<?php

namespace App\Models\Clients;

use Illuminate\Http\Request;
use App\Models\Clients\Candidate;
use App\Models\Attachments\Attachment;
use Illuminate\Support\Facades\Auth;
use  App\Models\Attachments\AttachmentService;

class CandidateService
{
    public function __construct(AttachmentService $attachSvc)
    {
        $this->attachSvc = $attachSvc;
    }

    public function getAllCandidates()
    {
        return Candidate::all()->sortBy('name');
    }

    public function getSpecificCandidates()
    {
        return Candidate::whereUserId(Auth::user()->id)->orderBy('name', 'asc')->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Like $like
     * @param  Array  $array
     * @return \Illuminate\Http\Response
     */
    public function updateCandidate($id, $array)
    {
        $candidate = Candidate::find($id);
        foreach ($array as $key => $value) {
            $candidate->$key = $value;
        }
        $candidate->save();
        return $candidate;
    }
    // public function addFileToCompany()
    // {
    //     $file = request()->file('file_upload');
    //     if ($file != null) {
    //         $path = storage_path()."/app/attachments";
    //         $original_name = $file->getClientOriginalName();
    //         $ext = pathinfo($original_name, PATHINFO_EXTENSION);
    //         $company =  Company::find(request()->input('company_id'));
    //         //add image & file compressor
    //         $hashed_name = md5($original_name. time()) . "." . $ext;
    //         $file->move($path, $hashed_name);
    //         $storedFile = $this->compSvc->addCompanyFiles($hashed_name, $original_name, $company);
    //         if ($storedFile != null) {
    //             $status = 1;
    //             $message = "File is successfully added!";
    //             $accounts = $company->employees;
    //             $companyFiles = $company->files;
    //             return redirect()->back()->with(['message' => $message, 'status' => $status]);
    //         }
    //     }
    //     $status = 0;
    //     $message = "Failed to add file";
    //     return redirect()->back()->with(['message' => $message, 'status' => $status]);
    // }


    public function addCandidateFile($array)
    {
        $file = $array['resume'];
        if ($file != null) {
            $original_name = $file->getClientOriginalName();
            $ext = pathinfo($original_name, PATHINFO_EXTENSION);
            $hashed_name = md5($original_name. time()) . "." . $ext;
            $filenameArray = explode('.', $hashed_name);
            $path =  storage_path() ."/app/resumes";
            // $file->move($path, $hashed_name);
            $savedFile = $this->attachSvc->uploadFile('resume/'. $hashed_name, $file);
            $candidate = Candidate::Create([
                  'name' => $array['name'],
                  'email' => $array['email'],
                  'title' => $array['title'],
                  'gender' => $array['gender'],
                  'handphone' => $array['handphone'],
                  'telephone' => $array['telephone'],
                  'industry' => $array['industry'],
                  'summary_keywords' => empty($array['keywords']) ? "" : $array['keywords'],
                  'birthdate' => $array['birthdate'],
                  'user_id' => Auth::user()->id
              ]);

            $file = new Attachment([
                'file_name' => $original_name,
                'hashed_name' => $hashed_name,
                'file_type' => end($filenameArray)
              ]);
            $candidate->files()->save($file);
            $file->attachable()->associate($candidate)->save();
            return $candidate;
        }
    }

    public function removeFile(Attachment $file)
    {
        try {
            $status = $this->attachSvc->deleteFile('/resume/'.$file->hashed_name);
            if (Auth::user() && $status) {
                $file->delete();
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            return 0;
        }
    }

    public function destroyCandidate(Candidate $candidate)
    {
        try {
            $file = Self::removeFile($candidate->files->first());
            if ($file == 1) {
                $candidate->delete();
                return redirect()->back()->with(['message' => "Candidate successfully removed", 'status' => 1]);
            } else {
                return redirect()->back()->with(['message' => "ERROR, Something happened, file not found", 'status' => 0]);
            }
        } catch (Exception $e) {
            return redirect()->back()->with(['message' => "ERROR, Something happened, file not found", 'status' => 0]);
        }
    }
}
