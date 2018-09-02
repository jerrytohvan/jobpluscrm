<?php

namespace App\Models\Tasks;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany('App\Models\Users\User');
    }
}
