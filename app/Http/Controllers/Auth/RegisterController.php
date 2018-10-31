<?php

namespace App\Http\Controllers\Auth;

use App\Models\Users\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Thomaswelton\LaravelGravatar\Facades\Gravatar;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    // use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('web');
    }

    public function adminlist()
    {
        $status = "";
        $message = "";
        $users = User::all();
        return view('layouts.admin_list', compact('message', 'status', 'users'));
    }

    public function updateAdmin()
    {
        $message = "User successfully updated!";
        $status = 1;

        $requestArray =  request()->all();
        $id = $requestArray['user_id'];

        $validator = Validator::make($requestArray, [
            'name' => 'required',
            'email' => 'required',
            'handphone' => 'numeric'
        ]);

        if ($validator->fails()) {
            $errorArray = $validator->errors()->all();
            $message = implode(" ", $errorArray);
            $status = 0;
            return redirect()->back()->with(['message' => $message, 'status' => $status]);
        } else {
            $user = User::where('id', $id)->first();
            $user -> name = $requestArray['name'];
            $user -> email =  $requestArray['email'];
            $user -> handphone = $requestArray['handphone'];
            $user -> tele_id = $requestArray['teleid'];
            $birthday = $requestArray['birthdate'];
            if ($birthday != "") {
                $user -> birth_date = $requestArray['birthdate'];
            }
            $user -> save();
            return redirect()->back()->with(['message' => $message, 'status' => $status]);
        }
    }

    public function resetAdmin()
    {
        $requestArray = request()->all();
        $id = $requestArray['id'];
        $user = User::where('id', $id)->first();

        $password = $requestArray['password'];
        $confirmpw = $requestArray['confirmpw'];
        if ($password == $confirmpw) {
            $user -> password = bcrypt($password);
            $user -> save();
            $message = "User successfully updated!";
            $status = 1;
        } else {
            $message = "Password does not match the confirm password.";
            $status = 0;
        }
        return redirect()->back()->with(['message' => $message, 'status' => $status]);
    }

    public function deleteAdmin()
    {
        $requestArray = request()->all();
        $id = $requestArray['uid'];
        $user = User::where('id', $id)->delete();

        if ($user = User::where('id', $id)->first()==null) {
            $message = "User successfully deleted!";
            $status = 1;
        } else {
            $message = "Failed to delete user";
            $status = 0;
        }
        return redirect()->back()->with(['message' => $message, 'status' => $status]);
    }

    public function index()
    {
        $status = "";
        $message = "";
        return Auth::user()->admin == 1 ? view('layouts.register', compact('message', 'status')): abort(403, 'Unauthorized action.');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            //user type verification
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function register(Request $data)
    {
        $status = 1;
        $message = "User successfully added";
        try {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'admin' => $data['admin'],
                'profile_pic' => Gravatar::src($data['email'])
            ]);
            return view('layouts.register', compact('message', 'status'));
        } catch (\Illuminate\Database\QueryException $exception) {
            $status = 0;
            $message = "This user already exist";
            return view('layouts.register', compact('message', 'status'));
        }
    }
}
