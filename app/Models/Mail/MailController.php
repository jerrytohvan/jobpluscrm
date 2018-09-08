<?php
namespace App\Models\Mail;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use Illuminate\Support\Facades\Storage;

use Mail;

class MailController extends Controller
{
    public function index()
    {
        return view('/layouts/index_mail');
    }



    public function sendemail()
    {
        Mail::send('/layouts/index_mail', [], function ($message) {
            $message->from('gabrielongxe@gmail.com', 'Gabriel');
            $message->to((request()->input('toEmail')))->subject('This is test e-mail');
            if (request()->input('ccEmail') != null) {
                $message->cc(request()->input('ccEmail'));
            }
            if (request()->input('emailAttachment') != null) {
                $message->attach(request()->file('emailAttachment'));
            }
            $message->setBody(request()->input('emailMessage'));
            error_log(print_r("sending", true));
        });
        error_log(print_r("sent", true));
        return view('layouts.index_mail', compact('message'));
    }
    // method to send to add attachment succesfully

    // public function attachment_email(){
    //    $data = array('name'=>"trying attachment");
    //    Mail::send('/layouts/mail', $data, function($message) {
    //       $message->to('gabriel.ong.2016@sis.smu.edu.sg', 'gab')->subject
    //          ('Laravel Testing Mail with Attachment');
    //       $message->attach('C:\Users\gabri\Documents\gab\gif\200.webp');
    //       $message->from('gabrielongxe@gmail.com','Gabriel');
    //    });
    //    return "Email Sent with attachment. Check your inbox.";
    // }



    // public function sendemailtoMany()
    // {
    //     $emails=[''];
    //
    //     Mail::send([], [], function ($message) use ($emails) {
    //         $message->from('gabrielongxe@gmail.com', 'Gabriel');
    //         $message->to($emails)->subject('This is test e-mail');
    //         if (request()->input('ccEmail') != null) {
    //             $message->cc(request()->input('ccEmail'));
    //         }
    //         if (request()->input('emailAttachment') != null) {
    //             $message->attach(request()->file('emailAttachment'));
    //         }
    //         $message->setBody(request()->input('emailMessage'));
    //     });
    //     var_dump(Mail:: failures());
    //     exit;
    // }
    // function to retrieve mail

    public function getMail()
    {
        /* connect to gmail */
        $hostname = '{imap.gmail.com:993/imap/ssl}INBOX';
        $username = 'gabrielongxe@gmail.com';
        $password = 'Heavenfire357';

        $inbox = imap_open($hostname, $username, $password) or die('Cannot connect: ' . imap_last_error());

        $emails = imap_search($inbox, 'ALL');

        if ($emails) {
            $output = '';
            $mails = array();

            rsort($emails);

            $counter=0;

            foreach ($emails as $email_number) {
                $header = imap_headerinfo($inbox, $email_number);
                $message = quoted_printable_decode(imap_fetchbody($inbox, $email_number, 1));

                $from = $header->from[0]->mailbox . "@" . $header->from[0]->host;
                $toaddress = $header->toaddress;
                if (imap_search($inbox, 'UNSEEN')) {
                    /*Store from and message body to database*/
                    // Email::create(['from'=>$from, 'body'=>$message]);
                    $mails[] = [$toaddress, $header, $from, $message];

                    break;
                }
            }
            dd($mails);
            return view('showMail', compact('data'));
        }
        imap_close($inbox);
    }

    public function showMail($id)
    {

              // get the id
        $message = Email::findOrFail($id);
        $m = $message->body;
        // show the view and pass the nerd to it
        return view('emails.showmail', compact('m'));
    }
}
