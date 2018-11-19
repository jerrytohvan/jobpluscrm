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
Route::get('/apply-jobs', [
'as' => 'apply.jobs',
'uses' => '\App\Models\Clients\ClientController@public_add_candidate'
]);

Route::post('/candidates-new', [
  'as' => 'add.new.candidate',
'uses' => '\App\Models\Clients\ClientController@add_new_candidate'
]);


Route::group(['middleware' => ['auth']], function () {
    Route::get('/', 'AccountController@index')->name('dashboard');
    Route::post('/', [
      'as' => 'dashboard',
    'uses' => 'AccountController@index'
      ]);
    Route::patch('/tasks/{id}', '\App\Models\Tasks\TaskService@updateTasksStatus');
    Route::patch('/tasks/remove/{id}', '\App\Models\Tasks\TaskService@destroyTask');
    Route::put('/tasks/updateAll', '\App\Models\Tasks\TaskService@updateTasksOrder');
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

    Route::post('/change-pw', [
  'as' => 'change.pwd',
  'uses' => '\App\Http\Controllers\Auth\RegisterController@resetPwd'
  ]);

    Route::get('/add-admin', [
      'as' => 'index.register',
      'uses' => '\App\Http\Controllers\Auth\RegisterController@index'
    ]);
    Route::post('/new-admin', [
      'as'=>'new.admin',
  'uses' => '\App\Http\Controllers\Auth\RegisterController@register'
  ]);

    Route::get('/admin-list', [
    'as' => 'admin.list',
    'uses' => '\App\Http\Controllers\Auth\RegisterController@adminlist'
    ]);

    Route::post('/admin/update', [
    'as' => 'update.admin',
    'uses' => '\App\Http\Controllers\Auth\RegisterController@updateAdmin'
    ]);

    Route::post('/admin/reset', [
    'as' => 'reset.admin',
    'uses' => '\App\Http\Controllers\Auth\RegisterController@resetAdmin'
    ]);

    Route::post('/admin/delete', [
      'as' => 'delete.admin',
      'uses' => '\App\Http\Controllers\Auth\RegisterController@deleteAdmin'
      ]);

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

    Route::post('/candidate/remove', [
    'as' => 'delete.candidate',
    'uses' => '\App\Models\Clients\ClientController@removeCandidate'
    ]);


    Route::post('/account-new', [
      'as' => 'add.new.account',
    'uses' => '\App\Models\Clients\ClientController@add_new_account'
    ]);
    Route::get('candidate/resume/{file}', [
        'as' => 'get.resume',
        'uses' => '\App\Models\Clients\ClientController@getResume'
        ]);
    Route::get('/file/{file}', [
            'as' => 'get.file',
            'uses' => '\App\Models\Clients\ClientController@getFile'
            ]);

    Route::post('/update/account', [
        'as' => 'update.account',
        'uses' => '\App\Models\Clients\ClientController@updateAccount'
        ]);

    Route::post('/delete', [
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

    Route::get('/smart-match/{candidate}', [
    'as' => 'smart.match.candidate',
    'uses' => '\App\Models\MachineLearning\SmartMatchController@resultsSmartMatch'
    ]);

    Route::post('/match', [
    'as' => 'match.candidate',
    'uses' => '\App\Models\MachineLearning\SmartMatchController@matchCandidatesWithJobsToJson'
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

    Route::post('/note/delete', [
      'as' => 'delete.note',
      'uses' => '\App\Models\Clients\ClientController@removeNote'
    ]);
    Route::post('/editnote', [
        'as' => 'edit.note',
      'uses' => '\App\Models\Clients\ClientController@editNote'
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

    Route::post('/deletecompany', [
'as' => 'delete.company',
'uses' => '\App\Models\Clients\ClientController@removeCompany'
]);
    Route::get('/companies-new', [
  'as' => 'companies.new',
'uses' => '\App\Models\Clients\ClientController@index_companies_new'
]);

    Route::post('/companies-industry', [
  'as' => 'companies.industry',
'uses' => '\App\Models\Clients\ClientController@filterByIndustry'
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
    Route::post('/deletepost', [
    'as' => 'delete.post',
    'uses' => '\App\Models\SocialWall\SocialWallController@removePost'
  ]);
    Route::post('/editpost', [
      'as' => 'edit.post',
    'uses' => '\App\Models\SocialWall\SocialWallController@editPost'
    ]);
    Route::get('/likepost', [
      'as' => 'like.post',
    'uses' => '\App\Models\SocialWall\SocialWallController@postLikePost'
    ]);
    Route::get('/calendar', [
      'as' => 'index.calendar',
    'uses' => '\App\Models\Calendar\CalendarController@index'
    ]);

    Route::post('/calendar/create', [
      'as' => 'add.calendar',
    'uses' => '\App\Models\Calendar\CalendarController@add_new_event'
    ]);

    Route::get('/mail', [
      'as' => 'index.mail',
    'uses' => '\App\Models\Mail\MailController@index'
    ]);
    Route::get('/task', [
      'as' => 'index.tasks',
    'uses' => '\App\Models\Tasks\TaskController@index'
    ]);
    Route::post('/task/edit', [
      'as' => 'edit.task',
    'uses' => '\App\Models\Tasks\TaskController@editTask'
    ]);

    Route::post('/task/add', [
      'as' =>'add.tasks',
      'uses' => '\App\Models\Tasks\TaskController@createTask'
    ]);

    //added for new task in company view
    Route::post('/task/addtask', [
      'as' =>'add.new.tasks',
      'uses' => '\App\Models\Tasks\TaskController@createTaskInCompanyView'
    ]);


    Route::get('/smart-match', [
      'as' => 'index.smart.match',
    'uses' => '\App\Models\MachineLearning\SmartMatchController@index'
    ]);
    Route::post('/match-employee-job', [
      'as' => 'search.job',
    'uses' => '\App\Models\MachineLearning\SmartMatchController@matchDescriptionWithPotentialJobs'
    ]);
    Route::get('/jobs/list', [
      'as' => 'jobs.list',
    'uses' => '\App\Models\Jobs\JobController@index'
    ]);

    Route::get('/jobs/new', [
      'as' => 'jobs.new',
    'uses' => '\App\Models\Jobs\JobController@index_job_new'
    ]);

    Route::post('/jobs/add', [
      'as' => 'add.job',
    'uses' => '\App\Models\Jobs\JobController@add_jobs'
    ]);

    //added
    Route::post('/jobs/update', [
      'as' => 'update.job',
      'uses' => '\App\Models\Jobs\JobController@update_job'
    ]);

    Route::post('/jobs/delete', [
      'as' => 'delete.job',
    'uses' => '\App\Models\Jobs\JobController@delete_job'
    ]);

    Route::post('/admin/revoke',[
      'as' => 'revoke.admin',
      'uses' => '\App\Http\Controllers\Auth\RegisterController@revokeAdmin'
    ]);

    Route::post('/admin/promote',[
      'as' => 'promote.admin',
      'uses' => '\App\Http\Controllers\Auth\RegisterController@promoteAdmin'
    ]);
});
Route::get('/tasks/data', '\App\Models\Tasks\TaskController@display');
// Route::get('/telegram', [
//   'as' => 'telegram',
// 'uses' => '\App\Models\Chats\TelegramController@index'
// ]);

// Route::post('/telegram-message', [
//   'as' => 'send.message',
// 'uses' => '\App\Models\Chats\TelegramController@sendMessageTest'
// ]);

//For testing telegram message
Route::get('/telegram-send', [
  'as' => 'telegram.send',
'uses' => '\App\Models\Chats\TelegramController@send'
]);

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
Route::get('/tasks', '\App\Models\Tasks\TaskController@display');
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
Route::get('/resumes', 'ResumesController@index');
Route::get('/resumes/{id}', 'ResumesController@show');
Route::post('/resumes/create', 'ResumesController@store');
Route::delete('/resumes/{id}', 'ResumesController@destroy');
Route::put('/resumes/{id}', 'ResumesController@update');
Route::put('/tasks/{id}', 'TasksController@update');
Route::get('/resumes', 'ResumesController@index');
Route::get('/resumes/{id}', 'ResumesController@show');
Route::post('/resumes/create', 'ResumesController@store');
Route::delete('/resumes/{id}', 'ResumesController@destroy');
Route::put('/resumes/{id}', 'ResumesController@update');
Route::put('/tasks/{id}', 'TasksController@update');
Auth::routes();
Route::get('/gcalendar', 'gCalendarController@index');
Route::post('/gcalendar/create', 'gCalendarController@store');
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
    Route::post('/mail', [
        'as' => 'sendemail',
      'uses' => '\App\Models\Mail\MailController@sendemail'
      ]);


// metrics routes
Route::get('/dashboard/newLeadsComparison', [
  'as' => 'newLeadsComparison',
  'uses' => '\App\Http\Controllers\MetricsController@newLeadsComparison'
  ]);

  Route::get('/dashboard/taskCompletedComparison', [
    'as' => 'taskCompletedComparison',
    'uses' => '\App\Http\Controllers\MetricsController@taskCompletedComparison'
    ]);

  Route::get('/dashboard/tasksOverdue', [
      'as' => 'tasksOverdue',
      'uses' => '\App\Http\Controllers\MetricsController@tasksOverdue'
      ]);

      Route::get('/dashboard/taskThisWeek', [
          'as' => 'taskThisWeek',
          'uses' => '\App\Http\Controllers\MetricsController@taskThisWeek'
          ]);




// Route::get('/tasks/data', '\App\Models\Tasks\TaskController@display');

  // Route::post('sendemail', 'MailController@sendemail');
  Route::post('displayemail', 'MailController@displayemail');
  Route::post('/mail', [
      'as' => 'sendemail',
    'uses' => '\App\Models\Mail\MailController@sendemail'
    ]);

    Route::post('processTaskForEmail', [
        'as' => 'processTaskForEmail',
      'uses' => '\App\Models\Mail\MailController@processTaskForEmail'
      ]);
