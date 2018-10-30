<?php

namespace App\Models\Users;

use App\Models\Users\User;
use App\Models\Clients\Company;
use App\Models\Users\UserCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
    
    public function attachUserWithCompany(User $user, Company $company)
    {
        $user->companies()->attach($company->id);
        $userCompany = UserCompany::whereUserId($user->id)->whereCompanyId($company->id)->first();
        $now = Carbon::now()->format('Y-m-d h:i:s');
        $userCompany->created_at = $now;
        $userCompany->updated_at = $now;
        $userCompany->save();
        if ($userCompany) {
            return 1;
        }
        return 0;
    }
    public function detachUserFromCompany(User $user, Company $company)
    {
        if ($user->companies()->detach($company->id)) {
            return 1;
        };
        return 0;
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
