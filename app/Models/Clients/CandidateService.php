<?php

namespace App\Models\Clients;

use Illuminate\Http\Request;
use App\Models\Clients\Candidate;
use App\Models\Attachments\Attachment;

class CandidateService
{
    public function getAllCandidates()
    {
        return Candidate::all()->sortBy('name');
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


    public function addCandidateFile($array)
    {
        $file = $array['resume'];
        if ($file != null) {
            $original_name = $file->getClientOriginalName();
            $ext = pathinfo($original_name, PATHINFO_EXTENSION);
            $hashed_name = md5($original_name. time()) . "." . $ext;
            $filenameArray = explode('.', $hashed_name);
            $path =  storage_path() ."/app/resumes";
            if ($file->move($path, $hashed_name)) {
                $candidate = Candidate::Create([
                  'name' => $array['name'],
                  'email' => $array['email'],
                  'title' => $array['title'],
                  'gender' => $array['gender'],
                  'handphone' => $array['handphone'],
                  'telephone' => $array['telephone'],
                  'birthdate' => $array['birthdate']
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
        return null;
    }

    public function removeFile(Attachment $file)
    {
        $path = storage_path()."/app/resumes/";
        $fileDir = $path . $file->hashed_name;
        unlink($fileDir);
        if (!file_exists($fileDir)) {
            $file->delete();
            return 1;
        }
        return  0;
    }

    public function destroyCandidate(Candidate $candidate)
    {
        $file = Self::removeFile($candidate->files->first());
        if ($file == 1) {
            $candidate->delete();
        }
    }
}
