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

Auth::routes();
Route::get('/', 'AccountController@index');

Route::group(['middleware' => ['web']], function(){

  // Route::get('/register', [
  //   'as' => 'register',
  //   'uses' => 'AccountController@register',
  // ]);
  //
  // Route::get('/logout', [
  //   'as' => 'logout',
  //   'uses' => '\App\Models\Users\UserController@logout',
  // ]);
});
