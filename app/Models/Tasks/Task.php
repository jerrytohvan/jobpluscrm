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
    
    public function companies()
    {
        return $this->belongsToMany('App\Models\Clients\Company');
    }

    public function employees()
    {
        return $this->belongsToMany('App\Models\Employees\Employee');
    }
}
