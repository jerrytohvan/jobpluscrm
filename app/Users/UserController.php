<?php

namespace App\Users;

use App\Users\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
  public function signUp(Request $request){
    // validation helper: request and rules parameters. if failed will be validated back
    $this->validate($request, [
      'email' => 'email|required|unique:users',
      'name' => 'required|max:50',
      'password' => 'required|min:4'
    ]);

    $name = $request->name;
    $email = $request->email;
    $password = bcrypt($request->password);

    $user = new User();
    $user->email = $email;
    $user->name = $name;
    $user->password = $password;

    $user->save();

    //protect the routes through laravel's helper method
    Auth::login($user);

    return redirect()->route('dashboard');
 }
     public function signIn(Request $request){
         $this->validate($request, [
           'email' => 'required',
           'password' => 'required'
         ]);

         if(Auth::attempt(['email' => $request->email1 , 'password' => $request->password1])){
           return redirect()->route('dashboard');
         }else{
           return redirect()->back();
         }

     }

     public function logout(){
       Auth::logout();
       return redirect()->route('/');
     }
}
