 <?php
// require __DIR__ . '/vendor/autoload.php';

// if (php_sapi_name() != 'cli') {
//     throw new Exception('This application must be run on the command line.');
// }

// /**
//  * Returns an authorized API client.
//  * @return Google_Client the authorized client object
//  */
// function getClient()
// {
//     $client = new Google_Client();
//     $client->setApplicationName('Google Calendar API PHP Quickstart');
//     $client->setScopes(Google_Service_Calendar::CALENDAR);
//     $client->setAuthConfig('FYPCALAPI-36e1f070d86b.json');
//     $client->setAccessType('offline');

//     // Load previously authorized credentials from a file.
//     $credentialsPath = 'token.json';
//     if (file_exists($credentialsPath)) {
//         $accessToken = json_decode(file_get_contents($credentialsPath), true);
//     } else {
//         // Request authorization from the user.
//         $authUrl = $client->createAuthUrl();
//         printf("Open the following link in your browser:\n%s\n", $authUrl);
//         print 'Enter verification code: ';
//         $authCode = trim(fgets(STDIN));

//         // Exchange authorization code for an access token.
//         $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);

//         // Store the credentials to disk.
//         if (!file_exists(dirname($credentialsPath))) {
//             mkdir(dirname($credentialsPath), 0700, true);
//         }
//         file_put_contents($credentialsPath, json_encode($accessToken));
//         printf("Credentials saved to %s\n", $credentialsPath);
//     }
//     $client->setAccessToken($accessToken);

//     // Refresh the token if it's expired.
//     if ($client->isAccessTokenExpired()) {
//         echo "token has expiredddddd";
//         $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
//         file_put_contents($credentialsPath, json_encode($client->getAccessToken()));
//     }
//     return $client;
// }


// // Get the API client and construct the service object.
// $client = getClient();
// $service = new Google_Service_Calendar($client);

// $event = new Google_Service_Calendar_Event(array(
//     'summary' => 'Google I/O 2015',
//     'location' => '800 Howard St., San Francisco, CA 94103',
//     'description' => 'A chance to hear more about Google\'s developer products.',
//     'start' => array(
//       'dateTime' => '1532529178132',
//       'timeZone' => 'America/Los_Angeles',
//     ),
//     'end' => array(
//       'dateTime' => '1532629178132',
//       'timeZone' => 'America/Los_Angeles',
//     ),
//     'recurrence' => array(
//       'RRULE:FREQ=DAILY;COUNT=2'
//     ),
//     'attendees' => array(
//       array('email' => 'lpage@example.com'),
//       array('email' => 'sbrin@example.com'),
//     ),
//     'reminders' => array(
//       'useDefault' => FALSE,
//       'overrides' => array(
//         array('method' => 'email', 'minutes' => 24 * 60),
//         array('method' => 'popup', 'minutes' => 10),
//       ),
//     ),
//   ));
  
//   $calendarId = 'primary';
//   $event = $service->events->insert($calendarId, $event);
//   printf('Event created: %s\n', $event->htmlLink);
// Print the next 10 events on the user's calendar.
// $calendarId = 'primary';
// $optParams = array(
//   'maxResults' => 10,
//   'orderBy' => 'startTime',
//   'singleEvents' => true,
//   'timeMin' => date('c'),
// );
// $results = $service->events->listEvents($calendarId, $optParams);

// if (empty($results->getItems())) {
//     print "No upcoming events found.\n";
// } else {
//     print "Upcoming events:\n";
//     foreach ($results->getItems() as $event) {
//         $start = $event->start->dateTime;
//         if (empty($start)) {
//             $start = $event->start->date;
//         }
//         printf("%s (%s)\n", $event->getSummary(), $start);
//     }
// }