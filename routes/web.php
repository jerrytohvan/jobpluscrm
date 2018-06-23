<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware' => ['web']], function(){

  Route::get('/', function () {
      return view('welcome'); //points to welcome.blade.php
  })->name('/');

  Route::get('/dashboard', [
    'as' => 'dashboard',
    'uses' => 'AccountController@index',
  ]);

  Route::post('/login', [
      'as' => 'login',
      'uses' => 'UserController@signIn',
  ]);

  Route::get('/register', [
    'as' => 'register',
    'uses' => 'AccountController@register',
  ]);

  Route::get('/logout', [
    'as' => 'logout',
    'uses' => 'UserController@logout',
  ]);

});
