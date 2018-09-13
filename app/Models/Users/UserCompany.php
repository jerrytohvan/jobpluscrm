<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Models\Users\User;
use  App\Models\Clients\Company;

class UserCompany extends Pivot
{
    protected $table = 'user_company';
    protected $guarded = [];
}
