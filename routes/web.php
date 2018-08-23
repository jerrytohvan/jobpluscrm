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
    Auth::routes();
    Route::get('/', 'AccountController@index')->name('dashboard');



    Route::get(
      '/accounts-full-list',
  ['as' => 'accounts.fulllist',
   'uses' => '\App\Models\Clients\ClientController@index_account_full_list'
 ]
  );


    Route::get('/accounts-new', [
    'as' => 'accounts.new',
  'uses' => '\App\Models\Clients\ClientController@index_account_new'
]);

    Route::post('/accounts-new', [
  'as' => 'add.new.account',
'uses' => '\App\Models\Clients\ClientController@add_new_account'
]);

    Route::get('/companies-full-list', [
    'as' => 'companies.fulllist',
  'uses' => '\App\Models\Clients\ClientController@index_companies_full_list'
]);

    Route::get('/companies-new', [
  'as' => 'companies.new',
'uses' => '\App\Models\Clients\ClientController@index_companies_new'
]);

    Route::post('/companies-new', [
  'as' => 'add.new.company',
'uses' => '\App\Models\Clients\ClientController@add_new_company'
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

  Route::post('/newpost',  [
    'as' => 'new.post',
  'uses' => '\App\Models\SocialWall\SocialWallController@addPost'
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

    // Route::get('/register', [
    //   'as' => 'register',
    //   'uses' => 'AccountController@register',
    // ]);
    // Route::get('/register-account',  [
    //   'as' => 'register.account',
    // 'uses' => '\App\Models\Mail\MailController@index'
    // ]);
});

	 Route::get('/createprofile',  [
    'as' => 'create.profile',
   'uses' => '\App\Models\CreateProfile\CreateProfileController@index'
   ]);

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

Auth::routes();
Route::resource('/gcalendar', 'gCalendarController');
Route:: get('/callback', [
  'as' => 'cal.index',
  'uses' => 'gCalendarController@callback'
]);
Route::get('oauth', [
  'as' => 'oauthCallback',
  'uses' => 'gCalendarController@oauth']);
