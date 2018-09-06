<?php
namespace App\Models\Mail;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use Mail;

class MailController extends Controller
{
  public function index(){
     return view('/layouts/index_mail');
  }

  // basic test mail method  - This method works
  public function sendemail(){

    Mail::send([], [], function ($message) {
        $message->from('gabrielongxe@gmail.com', 'Gabriel');
        $message->to(request()->input('toEmail'))->subject('my test email works');
        if(request()->input('ccEmail') != null){
            $message->cc(request()->input('ccEmail'));
        }
        $message->attach(request()->file('emailAttachment'));
        $message->setBody(request()->input('emailMessage')); // assuming text/plain

    });
    return "Your email has been sent successfully";
  }

  // method to send HTML emails

  // method to emails with attachement
     public function attachment_email(){
        $data = array('name'=>"trying attachment");
        Mail::send('/layouts/mail', $data, function($message) {
           $message->to('gabriel.ong.2016@sis.smu.edu.sg', 'gab')->subject
              ('Laravel Testing Mail with Attachment');
           $message->attach('C:\Users\gabri\Documents\gab\gif\200.webp');
           $message->from('gabrielongxe@gmail.com','Gabriel');
        });
        return "Email Sent with attachment. Check your inbox.";
     }



     public function test(){

      $message = request()->input('Content');
      dd($message);
      return redirect()->route('layouts.index_mail')->with(['message']);
}


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
            $message = quoted_printable_decode (imap_fetchbody($inbox, $email_number, 1));

            $from = $header->from[0]->mailbox . "@" . $header->from[0]->host;
            $toaddress = $header->toaddress;
            if(imap_search($inbox, 'UNSEEN')){
                /*Store from and message body to database*/
              // Email::create(['from'=>$from, 'body'=>$message]);
              $mails[] = [$toaddress, $header, $from, $message];

              break;
            }

        }
        dd($mails);
        return view('showMail',compact('data'));

    }
        imap_close($inbox);
}

public function showMail($id){

    // get the id
    $message = Email::findOrFail($id);
    $m = $message->body;
    // show the view and pass the nerd to it
    return view('emails.showmail',compact('m'));
}
}
