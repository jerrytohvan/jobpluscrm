<?php

namespace App\Models\Users;

use App\Users\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserService
{
    /**
     * Checks user existed and creates a new user
     * @param  Array   $array
     * @return User $user
     * @author jerrytohvan
     */
    public function createUser(array $array)
    {
        return User::create(['name' => $array->name,
        'email' => $array->email,
      'password' => bcrypt($array->password),
      'admin' => $array->admin
      ]);
    }

    public function updateUserProfile(User $user)
    {
        $array = request()->all();
        foreach ($array as $key => $value) {
            $user->$key = $value;
        }
        $user->save();
        return $user;
    }
    public function updateProfilePicture()
    {
    }
    public function compressImage()
    {
    }
    public function getUserAnalytics()
    {
    }

    public function getUserRecentActivities()
    {
    }

    public function getUserProjectHistory()
    {
    }
}
