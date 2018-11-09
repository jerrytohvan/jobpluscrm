<?php

namespace App\Models\Users;

use App\Users\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\ActivityLog\ActivityLogService;
use App\Models\Attachments\AttachmentService;

class UserController extends Controller
{
    public function __construct(UserService $userSvc, ActivityLogService $actService, AttachmentService $attService)
    {
        $this->middleware('auth');
        $this->svc = $userSvc;
        $this->actSvc = $actService;
        $this->attSvc = $attService;
    }

    public function index()
    {
        $user = Auth::user();
        $pic = $user['profile_pic'];
        $url = parse_url($pic);
        if (!empty($url['scheme'])) {
            $user_pic = $pic;
        } else {
            $user_pic = 'https://jobplusplus.s3.amazonaws.com' . $pic;
        }
        $activities = $this->actSvc->getActivitiesByUser($user);
        return view('layouts.user_profile', compact('user', 'activities', 'user_pic'));
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
        $user = Auth::user();
        $userOldPic = $user['profile_pic'];
        $id =  $user->id;

        $user->name = request()->input('name');
        $user->email =  request()->input('email');
        $user->handphone = request()->input('handphone');
        $user->tele_id = request()->input('tele_id');
        $user->birth_date =  request()->input('birthday');

        if (request()->hasFile('photo')) {
            $photo = request()->file('photo');
            $ext = $photo->getClientOriginalExtension();
            $userPic = "user_" . $id;
            $hashedPic = md5($userPic . time()) . "." . $ext;
            $url =  '/images/'  . $hashedPic;
            $user->profile_pic = $url;
            $this->attSvc->deleteFile($userOldPic);
            $uploadPic =  $this->attSvc->uploadFile($url, $photo);
        }
        $user->save();

        return redirect()->route('show.profile');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->back();
    }
}
