<?php

namespace App\Models\Clients;

use Illuminate\Http\Request;
use App\Models\Attachments\Attachment;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Filesystem\Filesystem;

class CompanyService
{

  /**
   * Store a newly created resource in storage.
   *
   * @param  Array $array
   * @return \Illuminate\Http\Response
   */
    public function storeCompany($array)
    {
        return Company::Create([
        'name' =>$array['name'],
        'address' => $array['address'],
        'email' => $array['email'],
        'telephone_no' => $array['telephone_no'],
        'client' => $array['client'],
        'website' => $array['website'],
        'no_employees' => $array['no_employees'],
        'industry' => $array['industry'],
        'lead_source' => $array['lead_source'],
        'transaction' => $array['transaction'],
        'description' => $array['description'],
        'type'=> $array['type']
      ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Like $like
     * @param  Array  $array
     * @return \Illuminate\Http\Response
     */
    public function updateCompany($id, $array)
    {
        $company = Company::find($id);
        foreach ($array as $key => $value) {
            $company->$key = $value;
        }
        $company->save();
        return $company;
    }

    // public function addCompanyFiles($hashedName, $fileName, Company $company)
    // {
    //     $fileDir = storage_path() ."/app/attachments/".$hashedName;
    //     $filenameArray = explode('.', $hashedName);
    //     if (file_exists($fileDir)) {
    //         $file = new Attachment([
    //           'file_name' => $fileName,
    //           'hashed_name' => $hashedName,
    //           'file_type' => end($filenameArray)
    //       ]);
    //         $company->files()->save($file);
    //         $file->attachable()->associate($company)->save();
    //         return $file;
    //     }
    //     return null;
    // }

    public function addCompanyFiles($hashedName, $fileName, Company $company)
    {
        $fileDir = storage_path() ."/app/attachments/".$hashedName;
        $filenameArray = explode('.', $hashedName);
        $exists = Storage::disk('s3')->exists($hashedName);
        if ($exists) {
            $file = new Attachment([
                  'file_name' => $fileName,
                  'hashed_name' => $hashedName,
                  'file_type' => end($filenameArray)
              ]);
            $company->files()->save($file);
            $file->attachable()->associate($company)->save();
            return $file;
        }
        return null;
    }



    public function removeFile(Attachment $file)
    {
        $path = storage_path()."/app/attachments/";
        $fileDir = $path . $file->hashed_name;
        unlink($fileDir);
        if (!file_exists($fileDir)) {
            $file->delete();
            return 1;
        }
        return  0;
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  Like  $like
     * @return \Illuminate\Http\Response
     */
    public function destroyCompany($id)
    {
        Company::findOrFail($id)->delete();
        return 204;
    }
}
