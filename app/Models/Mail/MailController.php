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

      public function sendemail(Request $request)
      {
          $data = array(
            'toEmail' =>$request->toEmail,
            'subject'=>$request->subject,
            'emailMessage' =>$request->emailMessage,
            'emailAttachment'=>$request->emailAttachment,
            'ccEmail'=>$request->ccEmail

          );
            Mail::send([], $data, function ($message) use ($data) {
                $message->from('gabrielongxe@gmail.com','Gabriel');
                $message->to($data['toEmail']);
                if ($data['ccEmail'] != null) {
                    $message->cc($data['ccEmail']);
                }
                $message->subject($data['subject']);
                if (request()->file('emailAttachment') != null) {
                      $message->attach($data['emailAttachment']->getRealPath(),
                      array(
                          'as'=>'emailAttachment.'. $data['emailAttachment']->getClientOriginalExtension(),
                          'mime'=>$data['emailAttachment']->getMimeType())
                      );
                 }

                $message->setBody($data['emailMessage']);
                error_log(print_r("sending", true));
            });

        error_log(print_r("sent", true));
        return view('layouts.index_mail', compact('message'));
    }

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
// YY CAN EDIT AFTER HERE
    Public function processYYdata(Array $array){
        $keys = $array[0];
        $values =$array[1];
        for($i = 0 ; $i<=sizeof($keys); $i++){
          //where the send email to is supposed to be
            $emailTo = User::whereId($keys[i])->email;
            for($j=0; $j<=sizeOf($value[i]); $j++){
                $message = $value[$j];
                $formattedMessage = str_replace(',','/n',$message);
            // where your data is supposed to be
                $data = array(
                  'toEmail' =>$emailTo,
                  'subject'=>$taskSubject,
                  'emailMessage' =>$taskText,
                  'tasks'=>$tasks['tasklist'],
                );
                sendTasksEmail($data);
            }
        }
      }

      public function sendTasksEmail($data)
      {
            Mail::send([], $data, function ($message) use ($data) {
                $message->from('gabrielongxe@gmail.com','Gabriel');
                $message->to($data['toEmail']);
                $message->subject($data['subject']);
                $message->setBody($data['emailMessage']);
                error_log(print_r("sending", true));
            });
        error_log(print_r("sent", true));
        return view('layouts.index_mail', compact('message'));
    }
}
