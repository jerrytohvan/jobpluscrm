<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Models\Users\User;
use  App\Models\Clients\Company;
use Spatie\Activitylog\Traits\LogsActivity;

class UserCompany extends Pivot
{
    use LogsActivity;

    protected $table = 'user_company';
    protected $guarded = [];
    protected static $logAttributes = ["*"];
}
