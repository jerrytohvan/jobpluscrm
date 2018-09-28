<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Google_Service_Calendar_EventDateTime;
// use App\Models\Tasks\Task;
// use App\Models\Tasks\TaskService;
// use App\Http\Controllers\TasksController;
class gCalendarController extends Controller
{
    protected $client;
    // public function __constructSVC(TaskService $taskSvc)
    // {
    //     $this->svc = $taskSvc;
    //     // $this->middleware('auth');
    // }
    public function __construct()
    {
        echo 'initialiszing ==============';
        $client = new Google_Client();
        // $client->setAuthConfig('../FYPCALAPI-36e1f070d86b.json');
        $client->setAuthConfig('../client_secret.json');        
        $client->addScope(Google_Service_Calendar::CALENDAR);
        
        // this 2 lines can be removed for live server
        // $guzzleClient = new \GuzzleHttp\Client(array('curl' => array(CURLOPT_SSL_VERIFYPEER => false)));
        // $client->setHttpClient($guzzleClient);
        //
        $this->client = $client;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        error_log(print_r( 'gcal index ============',true));
        session_start();
        // error_log(print_r( $_SESSION['access_token'],true));
        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            error_log(print_r( 'gcal index2toke ============',true));
            $this->client->setAccessToken($_SESSION['access_token']);
            $service = new Google_Service_Calendar($this->client);
            $calendarId = 'primary';
            $results = $service->events->listEvents($calendarId);
            return $results;
        } else {
            error_log(print_r( 'gcal index2oath ============',true));
            return redirect()->route('oauthCallback');
        }
    }
    public function oauth()
    {
        error_log(print_r( 'gcal oauth ============',true));
        session_start();
        // $rurl = action('gCalendarController@listAll');
        $rurl = 'http://localhost:8000/calendar';
        $this->client->setRedirectUri($rurl);
        if (!isset($_GET['code'])) {
            error_log(print_r( 'if yes ============',true));
            $auth_url = $this->client->createAuthUrl();
            $filtered_url = filter_var($auth_url, FILTER_SANITIZE_URL);
            error_log(print_r( $filtered_url,true));
            return redirect($filtered_url);
        } else {
            $this->client->authenticate($_GET['code']);
            error_log(print_r( 'if no ============',true));
            $_SESSION['access_token'] = $this->client->getAccessToken();
            return redirect()->route('cal.index');
        }
    }

    public function callback(){
        // console.log('chao ci bai');
        // Log::debug('An informational message.');
        error_log(print_r('ccb',true)); 
        print 'calling callback =====================';
    
        session_start();
        
        $client = new Google_Client();
        $client->setAuthConfigFile('client_secret.json');
        $client->setRedirectUri('http://' . $_SERVER['HTTP_HOST'] . '/oauth2callback.php');
        $client->addScope(Google_Service_Drive::DRIVE_METADATA);
        
        if (! isset($_GET['code'])) {
        $auth_url = $client->createAuthUrl();
        header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
        } else {
        $client->authenticate($_GET['code']);
        $_SESSION['access_token'] = $client->getAccessToken();
        $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
        }    session_start();
        
        $client = new Google_Client();
        $client->setAuthConfigFile('client_secret.json');
        $client->setRedirectUri('http://' . $_SERVER['HTTP_HOST'] . '/oauth2callback.php');
        $client->addScope(Google_Service_Drive::DRIVE_METADATA);
        
        if (! isset($_GET['code'])) {
        $auth_url = $client->createAuthUrl();
        header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
        } else {
        $client->authenticate($_GET['code']);
        $_SESSION['access_token'] = $client->getAccessToken();
        $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
        }
    }

    public function listAll()
    {
        error_log(print_r( 'gcal creating ===============',true));
        echo 'calendar working';
        // return view('calendar.createEvent');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        error_log(print_r( 'gcal creating ===============',true));
        // return view('calendar.createEvent');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Task $task)
    {
        error_log(print_r( 'gcal store ===============',true));
        session_start();
        // $startDateTime = $request->start_date;
        // $endDateTime = $request->end_date;
        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            $this->client->setAccessToken($_SESSION['access_token']);
            $service = new Google_Service_Calendar($this->client);
            $calendarId = 'primary';
            $event = new Google_Service_Calendar_Event([
                'summary' => $request->title,
                'description' => $request->description,
                // 'start' => ['dateTime' => $startDateTime],
                // 'end' => ['dateTime' => $endDateTime],
                'reminders' => ['useDefault' => true],
            ]);
            //return $this->svc->storeTask(request()->all());

            // return $event;
            error_log(print_r( 'gcal store success ===============',true));
            $results =  $service->events->insert($calendarId, $event);
             //$this->svc->storeTask(request()->all());
            if (!$results) {
                return response()->json(['status' => 'error', 'message' => 'Something went wrong']);
            }
            return response()->json(['status' => 'success', 'message' => 'Event Created']);
        } else {
            error_log(print_r( 'y return ===============',true));
            return redirect()->route('oauthCallback');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param $eventId
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function show($eventId)
    {
        error_log(print_r( 'gcal showing ===============',true));
        session_start();
        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            $this->client->setAccessToken($_SESSION['access_token']);
            $service = new Google_Service_Calendar($this->client);
            $event = $service->events->get('primary', $eventId);
            if (!$event) {
                return response()->json(['status' => 'error', 'message' => 'Something went wrong']);
            }
            return response()->json(['status' => 'success', 'data' => $event]);
        } else {
            return redirect()->route('oauthCallback');
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        error_log(print_r( 'gcal editing ===============',true));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param $eventId
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(Request $request, $eventId)
    {
        error_log(print_r( 'gcal updaitng ===============',true));
        session_start();
        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            $this->client->setAccessToken($_SESSION['access_token']);
            $service = new Google_Service_Calendar($this->client);
            $startDateTime = Carbon::parse($request->start_date)->toRfc3339String();
            $eventDuration = 30; //minutes
            if ($request->has('end_date')) {
                $endDateTime = Carbon::parse($request->end_date)->toRfc3339String();
            } else {
                $endDateTime = Carbon::parse($request->start_date)->addMinutes($eventDuration)->toRfc3339String();
            }
            // retrieve the event from the API.
            $event = $service->events->get('primary', $eventId);
            $event->setSummary($request->title);
            $event->setDescription($request->description);
            //start time
            $start = new Google_Service_Calendar_EventDateTime();
            $start->setDateTime($startDateTime);
            $event->setStart($start);
            //end time
            $end = new Google_Service_Calendar_EventDateTime();
            $end->setDateTime($endDateTime);
            $event->setEnd($end);
            $updatedEvent = $service->events->update('primary', $event->getId(), $event);
            if (!$updatedEvent) {
                return response()->json(['status' => 'error', 'message' => 'Something went wrong']);
            }
            return response()->json(['status' => 'success', 'data' => $updatedEvent]);
        } else {
            return redirect()->route('oauthCallback');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param $eventId
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function destroy($eventId)
    {
        error_log(print_r( 'gcal destory ===============',true));
        session_start();
        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            $this->client->setAccessToken($_SESSION['access_token']);
            $service = new Google_Service_Calendar($this->client);
            $service->events->delete('primary', $eventId);
        } else {
            return redirect()->route('oauthCallback');
        }
    }
}