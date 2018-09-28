<?php

namespace App\Models\Mail;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public function index()
    {
        return view('layouts.index_mail');
    }

    public function getData(Request $request)
    {
        // $client = new Client();

        // $request = $client->get('url', [
        //     GuzzleHttp\RequestOptions::JSON => ['foo' => 'bar'],
        // ]);
        error_log(print_r(typeof($request), true));
    }
}
