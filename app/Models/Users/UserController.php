<?php

namespace App\Models\Users;

use App\Users\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function __construct(UserService $userSvc)
    {
        $this->middleware('auth');
        $this->svc = $userSvc;
    }

    public function index()
    {
        $user = Auth::user();
        return view('layouts.user_profile', compact('user'));
    }
    public function signUp(Request $request)
    {
        // validation helper: request and rules parameters. if failed will be validated back
        $this->validate($request, [
      'email' => 'email|required|unique:users',
      'name' => 'required|max:50',
      'password' => 'required|min:4',
      'admin' => 'required|boolean'
    ]);
        $user = $this->svc->createUser($request);

        Auth::login($user);

        return redirect()->route('dashboard');
    }
    public function signIn(Request $request)
    {
        $this->validate($request, [
           'email' => 'required',
           'password' => 'required'
         ]);

        if (Auth::attempt(['email' => $request->email1 , 'password' => $request->password1])) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->back();
        }
    }
    public function updateProfile()
    {
        dd(request()->all());
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->back();
    }
}
