<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::group(['middleware' => ['web']], function () {
    Route::get('/login', [
    'as' => 'login',
    'uses' => '\App\Http\Controllers\Auth\LoginController@showLoginForm'
  ]);
    Route::post('/login', [
      'uses' => '\App\Http\Controllers\Auth\LoginController@login'
  ]);
    Route::get('/logout', [
    'as' => 'logout',
    'uses' => '\App\Http\Controllers\Auth\LoginController@logout'
  ]);
    Route::get('/profile', [
  'as' => 'show.profile',
  'uses' => '\App\Models\Users\UserController@index'
]);
    Route::post('/edit-profile', [
'as' => 'edit.profile',
'uses' => '\App\Models\Users\UserController@updateProfile'
]);
    Route::get('/add-admin', [
      'as' => 'index.register',
      'uses' => '\App\Http\Controllers\Auth\RegisterController@index'
    ]);
    Route::post('/new-admin', [
      'as'=>'new.admin',
  'uses' => '\App\Http\Controllers\Auth\RegisterController@register'
  ]);
    Route::get('/', 'AccountController@index')->name('dashboard');
    Route::get(
      '/candidates-full-list',
  ['as' => 'candidates.fulllist',
   'uses' => '\App\Models\Clients\ClientController@index_candidates_full_list'
 ]
  );
    Route::get('/candidates-new', [
    'as' => 'candidates.new',
  'uses' => '\App\Models\Clients\ClientController@index_candidates_new'
]);

    Route::get('/candidate/remove/{candidate}', [
    'as' => 'delete.candidate',
    'uses' => '\App\Models\Clients\ClientController@removeCandidate'
    ]);

    Route::post('/candidates-new', [
      'as' => 'add.new.candidate',
    'uses' => '\App\Models\Clients\ClientController@add_new_candidate'
    ]);

    Route::post('/account-new', [
      'as' => 'add.new.account',
    'uses' => '\App\Models\Clients\ClientController@add_new_account'
    ]);
    Route::get('candidate/resume/{file}', [
        'as' => 'get.resume',
        'uses' => '\App\Models\Clients\ClientController@getResume'
        ]);

    Route::post('/update/account', [
        'as' => 'update.account',
        'uses' => '\App\Models\Clients\ClientController@updateAccount'
        ]);

    Route::get('/delete/{employee_id}', [
        'as' => 'delete.account',
        'uses' => '\App\Models\Clients\ClientController@removeAccount'
        ]);

    Route::get('/companies/clients', [
'as' => 'companies.clients',
'uses' => '\App\Models\Clients\ClientController@index_companies_clients'
]);
    Route::get('/companies/leads', [
'as' => 'companies.leads',
'uses' => '\App\Models\Clients\ClientController@index_companies_leads'
]);
    Route::get('/convert/{company}', [
    'as' => 'convert.lead',
    'uses' => '\App\Models\Clients\ClientController@convertToClient'
    ]);

    Route::get('/candidate/match/{candidate}', [
    'as' => 'candidate.match',
    'uses' => '\App\Models\MachineLearning\SmartMatchController@matchCandidatesWithJobs'
    ]);

    Route::get('/view/{company}', [
'as' => 'view.company',
'uses' => '\App\Models\Clients\ClientController@showCompany'
]);

    Route::post('/view/{company}', [
  'as' => 'view.company',
  'uses' => '\App\Models\Clients\ClientController@showCompany'
  ]);
    Route::post('/view/{company}', [
      'as' => 'view.company',
      'uses' => '\App\Models\Clients\ClientController@showCompanyPost'
      ]);

    Route::get('/file/{file}', [
        'as' => 'get.file',
        'uses' => '\App\Models\Clients\ClientController@getFile'
        ]);

    Route::post('/update/company', [
        'as' => 'update.company',
        'uses' => '\App\Models\Clients\ClientController@updateCompany'
        ]);

    Route::post('/upload/company-file', [
        'as' => 'update.company.file',
        'uses' => '\App\Models\Clients\ClientController@addFileToCompany'
        ]);
    Route::get('/remove/company-file/{file}', [
            'as' => 'remove.company.file',
            'uses' => '\App\Models\Clients\ClientController@removeFileFromCompany'
            ]);

    Route::get('/deletecompany/{company_id}', [
'as' => 'delete.company',
'uses' => '\App\Models\Clients\ClientController@removeCompany'
]);
    Route::get('/companies-new', [
  'as' => 'companies.new',
'uses' => '\App\Models\Clients\ClientController@index_companies_new'
]);
    Route::post('/companies-new', [
  'as' => 'add.new.company',
'uses' => '\App\Models\Clients\ClientController@add_new_company'
]);
    Route::post('/attach/company', [
'as' => 'attach.user',
'uses' => '\App\Models\Clients\ClientController@attachToCompany'
]);
    Route::get('/detach/{company}/{user}', [
'as' => 'detach.user',
'uses' => '\App\Models\Clients\ClientController@detachFromCompany'
]);


    Route::get('/telegram', [
  'as' => 'telegram',
'uses' => '\App\Models\SocialWall\SocialWallController@index'
]);
    Route::get('/data-presentation', [
  'as' => 'data.presentation',
'uses' => 'AccountController@index_data_presentation'
]);
    Route::get('/settings', [
  'as' => 'settings',
'uses' => 'AccountController@index_settings'
]);
    Route::get('/socialwall', [
    'as' => 'social.wall',
  'uses' => '\App\Models\SocialWall\SocialWallController@index'
  ]);
    Route::post('/newpost', [
    'as' => 'new.post',
  'uses' => '\App\Models\SocialWall\SocialWallController@addPost'
  ]);
    Route::post('/newcompanypost/{company}', [
  'as' => 'new.company.post',
'uses' => '\App\Models\Clients\ClientController@addNote'
]);
    Route::get('/deletepost/{post_id}', [
    'as' => 'delete.post',
    'uses' => '\App\Models\SocialWall\SocialWallController@removePost'
  ]);
    Route::post('/editpost', [
      'as' => 'edit.post',
    'uses' => '\App\Models\SocialWall\SocialWallController@editPost'
    ]);
    Route::post('/likepost', [
      'as' => 'like.post',
    'uses' => '\App\Models\SocialWall\SocialWallController@postLikePost'
    ]);
    Route::get('/calendar', [
      'as' => 'index.calendar',
    'uses' => '\App\Models\Calendar\CalendarController@index'
    ]);
    Route::get('/mail', [
      'as' => 'index.mail',
    'uses' => '\App\Models\Mail\MailController@index'
    ]);
    Route::get('/event', [
      'as' => 'index.event',
    'uses' => '\App\Models\Events\EventController@index'
    ]);
    Route::get('/smart-match', [
      'as' => 'index.smart.match',
    'uses' => '\App\Models\MachineLearning\SmartMatchController@index'
    ]);
    Route::post('/match-employee-job', [
      'as' => 'search.job',
    'uses' => '\App\Models\MachineLearning\SmartMatchController@matchDescriptionWithPotentialJobs'
    ]);
});
Route::get('/employees', 'employeeController@index');
Route::get('/employees/{id}', 'employeeController@show');
Route::post('/employees/create', 'employeeController@store');
Route::delete('/employees/{id}', 'employeeController@destroy');
Route::put('/employees/{id}', 'employeeController@update');
Route::get('/projectGroups', 'ProjectGroupsController@index');
Route::get('/projectGroups/{id}', 'ProjectGroupsController@show');
Route::post('/projectGroups/create', 'ProjectGroupsController@store');
Route::delete('/projectGroups/{id}', 'ProjectGroupsController@destroy');
Route::put('/projectGroups/{id}', 'ProjectGroupsController@update');
Route::get('/companies', 'CompaniesController@index');
Route::get('/companies/{id}', 'CompaniesController@show');
Route::post('/companies/create', 'CompaniesController@store');
Route::delete(
    '/companies/{id}',
  // 'as' => 'delete.company',
  'CompaniesController@destroy'
);
// Route::get('/companies/{id}', [
// 'CompaniesController@destroy'
// );
Route::put('/companies/{id}', 'CompaniesController@update');
Route::get('/candidates', 'CandidatesController@index');
Route::get('/candidates/{id}', 'CandidatesController@show');
Route::post('/candidates/create', 'CandidatesController@store');
Route::delete('/candidates/{id}', 'CandidatesController@destroy');
Route::put('candidates/{id}', 'CandidatesController@update');
Route::get('/results', 'ResultsController@index');
Route::get('/results/{id}', 'ResultsController@show');
Route::post('/results/create', 'ResultsController@store');
Route::delete('/results/{id}', 'ResultsController@destroy');
Route::put('results/{id}', 'ResultsController@update');
Route::get('/interests', 'InterestsController@index');
Route::get('/interests/{id}', 'InterestsController@show');
Route::post('/interests/create', 'InterestsController@store');
Route::delete('/interests/{id}', 'InterestsController@destroy');
Route::put('/interests/{id}', 'InterestsController@update');
Route::get('/fields', 'FieldsController@index');
Route::get('/fields/{id}', 'FieldsController@show');
Route::post('/fields/create', 'FieldsController@store');
Route::delete('/fields/{id}', 'FieldsController@destroy');
Route::put('/fields/{id}', 'FieldsController@update');
Route::get('/messages', 'MessagesController@index');
Route::get('/messages/{id}', 'MessagesController@show');
Route::post('/messages/create', 'MessagesController@store');
Route::delete('/messages/{id}', 'MessagesController@destroy');
Route::put('/messages/{id}', 'MessagesController@update');
Route::get('/likes', 'LikesController@index');
Route::get('/likes/{like}', 'LikesController@show');
Route::post('/likes/create', 'LikesController@store');
Route::delete('/likes/{like}', 'LikesController@destroy');
Route::put('/likes/{like}', 'LikesController@update');
//API
Route::get('/employees', 'employeeController@index');
Route::get('/employees/{id}', 'employeeController@show');
Route::post('/employees/create', 'employeeController@store');
Route::delete('/employees/{id}', 'employeeController@destroy');
Route::put('/employees/{id}', 'employeeController@update');
Route::get('/projectGroups', 'ProjectGroupsController@index');
Route::get('/projectGroups/{id}', 'ProjectGroupsController@show');
Route::post('/projectGroups/create', 'ProjectGroupsController@store');
Route::delete('/projectGroups/{id}', 'ProjectGroupsController@destroy');
Route::put('/projectGroups/{id}', 'ProjectGroupsController@update');
Route::get('/companies', 'CompaniesController@index');
Route::get('/companies/{id}', 'CompaniesController@show');
Route::post('/companies/create', 'CompaniesController@store');
Route::delete('/companies/{id}', 'CompaniesController@destroy');
Route::put('/companies/{id}', 'CompaniesController@update');
Route::get('/candidates', 'CandidatesController@index');
Route::get('/candidates/{id}', 'CandidatesController@show');
Route::post('/candidates/create', 'CandidatesController@store');
Route::delete('/candidates/{id}', 'CandidatesController@destroy');
Route::put('candidates/{id}', 'CandidatesController@update');
Route::get('/results', 'ResultsController@index');
Route::get('/results/{id}', 'ResultsController@show');
Route::post('/results/create', 'ResultsController@store');
Route::delete('/results/{id}', 'ResultsController@destroy');
Route::put('results/{id}', 'ResultsController@update');
Route::get('/interests', 'InterestsController@index');
Route::get('/interests/{id}', 'InterestsController@show');
Route::post('/interests/create', 'InterestsController@store');
Route::delete('/interests/{id}', 'InterestsController@destroy');
Route::put('/interests/{id}', 'InterestsController@update');
// fields controllers
Route::get('/fields', 'FieldsController@index');
Route::get('/fields/{id}', 'FieldsController@show');
Route::post('/fields/create', 'FieldsController@store');
Route::delete('/fields/{id}', 'FieldsController@destroy');
Route::put('/fields/{id}', 'FieldsController@update');
//message controllers
Route::get('/messages', 'MessagesController@index');
Route::get('/messages/{id}', 'MessagesController@show');
Route::post('/messages/create', 'MessagesController@store');
Route::delete('/messages/{id}', 'MessagesController@destroy');
Route::put('/messages/{id}', 'MessagesController@update');
// likes controllers
Route::get('/likes', 'LikesController@index');
Route::get('/likes/{like}', 'LikesController@show');
Route::post('/likes/create', 'LikesController@store');
Route::delete('/likes/{like}', 'LikesController@destroy');
Route::put('/likes/{like}', 'LikesController@update');
// resume controllers
Route::get('/resumes', 'ResumesController@index');
Route::get('/resumes/{id}', 'ResumesController@show');
Route::post('/resumes/create', 'ResumesController@store');
Route::delete('/resumes/{id}', 'ResumesController@destroy');
Route::put('/resumes/{id}', 'ResumesController@update');
// Tasks controllers
Route::get('/tasks', 'TasksController@index');
Route::get('/tasks/{id}', 'TasksController@show');
Route::post('/tasks/create', 'TasksController@store');
Route::delete('/tasks/{id}', 'TasksController@destroy');
Route::put('/tasks/{id}', 'TasksController@update');
// resume controllers
Route::get('/resumes', 'ResumesController@index');
Route::get('/resumes/{id}', 'ResumesController@show');
Route::post('/resumes/create', 'ResumesController@store');
Route::delete('/resumes/{id}', 'ResumesController@destroy');
Route::put('/resumes/{id}', 'ResumesController@update');
//tasks controllers
Route::get('/tasks', 'TasksController@index');
Route::get('/tasks/{id}', 'TasksController@show');
Route::post('/tasks/create', 'TasksController@store');
Route::delete('/tasks/{id}', 'TasksController@destroy');
Route::put('/tasks/{id}', 'TasksController@update');
Auth::routes();
Route::resource('/gcalendar', 'gCalendarController');
Route:: get('/callback', [
  'as' => 'cal.index',
  'uses' => 'gCalendarController@callback'
]);
Route::get('oauth', [
  'as' => 'oauthCallback',
  'uses' => 'gCalendarController@oauth']);

  // email Routes
  // Route::post('sendemail', 'MailController@sendemail');
  Route::post('displayemail', 'MailController@displayemail');
  Route::post('sendEmail', 'MailController@sendEmail');



  Route::post('/mail', [
      'as' => 'sendemail',
    'uses' => '\App\Models\Mail\MailController@sendemail'
    ]);
