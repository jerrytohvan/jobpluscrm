<?php
namespace App\Models\Mail;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Support\Facades\Storage;
use Mail;
use App\Models\Clients\Company;
use App\Models\Clients\Candidate;
use App\Models\Clients\Job;
use App\Models\Tasks\Task;
use App\Models\Users\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Validation\Validator;
use Auth;

class MailController extends Controller
{
    public function index()
    {
        return view('/layouts/index_mail');
    }


    public function sendemail(Request $request)
    {
        //retrieve all request from email blade
        $arraReq = request()->all();
        error_log(print_r($arraReq, true));

        // comma deliminated arrays "toEmail"
        $toEmail = explode(",", $arraReq['toEmail']);
        // comma deliminated arrays "toEmail"
        $ccEmail=null;
        if (!empty($arraReq['ccEmail'])) {
            $ccEmail = explode(",", $arraReq['ccEmail']);
        }
        //format the message content into HTML
        $emailContent = $arraReq['emailMessage'];
        $formatMsg = nl2br($emailContent);

        // email data packet
        $data = array(
            'toEmail' =>$toEmail,
            'subject'=>$request->subject,
            'emailMessage' =>$formatMsg,
            'emailAttachment'=>$request->emailAttachment,
            'ccEmail'=>$ccEmail
          );
        // sending the email itself
        Mail::send([], $data, function ($message) use ($data) {
            $message->from('admin@jobplus.sg', 'JobPlus');
            $message->to($data['toEmail']);
            //check if there are cc email addresses
            if (!empty($data['ccEmail'])) {
                $message->cc($data['ccEmail']);
            }
            $message->subject($data['subject']);
            if (request()->file('emailAttachment') != null) {
                $message->attach(
                          $data['emailAttachment']->getRealPath(),
                      array(
                          'as'=>'emailAttachment.'. $data['emailAttachment']->getClientOriginalExtension(),
                          'mime'=>$data['emailAttachment']->getMimeType())
                      );
            }
            // text of the actual email
            //Fix Temp
            $msg = $data['emailMessage'];
            $msg = str_replace("<div>","\n",$msg);
            $msg = str_replace("<br>","\n",$msg);
            $msg = str_replace("</div>","",$msg);
            $msg = str_replace("</li><li>","\n",$msg);
            $msg = strip_tags($msg);
            $message->setBody($msg);
        });

        //error_log(print_r("sent", true));
        return redirect()->back()->with(compact('message'));
    }


    public function getMail()
    {
        /* connect to gmail */
        $hostname = '{imap.gmail.com:993/imap/ssl}INBOX';
        $username = 'admin@jobplus.sg';
        $password = '68169888';
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


    // Backend Methods
    // process each task and send it as an email
    public function processTaskForEmail(array $array)
    {
        $companyArr = array();
        $companies = Company::all();
        foreach ($companies as $company) {
            $id = $company['id'];
            $name = $company['name'];
            $companyArr[$id] = $name;
        }
        // retrieve user ID's
        $userids = $array[0];
        for ($i=0; $i<sizeof($userids); $i++) {
            $userid = $userids[$i];
            // person recieving the email is configured in this line
            $user_email = User::where('id', $userid)->pluck('email')->first();
            $messageArr = $array[1][$i];
            $message = "Task(s) to be done:\n\n";
            // Preoare message to be sent
            for ($j=0; $j<sizeof($messageArr); $j++) {
                $messageStr = $messageArr[$j];
                $index = strrpos($messageStr, ",");
                $companyId = substr($messageStr, 0, $index);
                $companyName = $companyArr[$companyId];
                $messageDesc = substr($messageStr, $index+1);

                if ($j == 0) {
                    $message .= "" .$companyName . ":\n" . $messageDesc;
                } else {
                    $message .= "\n\n" .$companyName . ":\n" . $messageDesc;
                }
            }
            // configure email data packet to call the method
            $data = array(
                'toEmail' =>$user_email,
                'subject'=>$messageDesc,
                'emailMessage' =>$message
              );
            // email is sent in this method
            $this->sendTasksEmail($data);
        }
    }
    // send the tasks email out
    public function sendTasksEmail($data)
    {
        $sent = false;
        error_log(print_r("start", true));
        Mail::send([], $data, function ($message) use ($data) {
            $message->from('admin@jobplus.sg', 'JobPlus');
            $message->to($data['toEmail']);
            $message->subject('Tasks to be done for today');
            $message->setBody($data['emailMessage']);
            error_log(print_r("sending", true));
        });
        error_log(print_r("sent", true));
        $sent = true;
        return $sent;
    }
}
