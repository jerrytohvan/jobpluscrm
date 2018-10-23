<?php

namespace App\Models\Attachments;

use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class AttachmentService
{
    public function __construct()
    {
        $this->url = 'https://s3.' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/';
        $this->s3 = Storage::disk('s3');
    }
    public function uploadFile($filename, $file)
    {
        return Storage::put($filename, file_get_contents($file));
    }

    public function deleteFile($filename)
    {
        if ($this->s3->exists($filename)) {
            return Storage::delete($filename);
        }
        return null;
    }
    public function retrieveFile($fileName)
    {
        $file =  Storage::get($fileName);
        return $file;
    }

    public function downloadFile($hashed_name, $filename)
    {
        $headers = [
            'Content-Disposition' => 'attachment; filename="'. $filename .'"',
          ];
        return Storage::download($hashed_name, $filename, $headers);
    }
}
