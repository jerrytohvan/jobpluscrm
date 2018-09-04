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
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $id = Auth::user()->id;
        $this->validate($request, [
          'name' => 'required|max:50',
          'email' => 'email|required',
        //   'password' => 'required|min:4',
          'handphone' => 'required|min:8,max:8',
          'tele_id' => 'required',
          'birthday' => 'required'
        ]);

        // $name = $request->input('name');
        // $email = $request->input('email');
        // $handphone = $request->input('handphone');
        // $tele_id = $request->input('tele_id');
        // $birthday = $request->input('birthday');
                
        $user -> name = $request->input('name');
        $user -> email = $request->input('email');
        $user -> handphone = $request->input('handphone');
        $user -> tele_id = $request->input('tele_id');
        $user -> birth_date = $request->input('birthday');

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $ext = $photo->getClientOriginalExtension();
            $memberPic = "member_". $id . "." . $ext;
            $url = "images/" . $memberPic;
            $user -> profile_pic = $url;
    
            $path = public_path()."\\images\\";
            $photo->move($path, $memberPic);
        }
       
        $user -> save();
        return redirect()->route('show.profile');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->back();
    }
}
