<?php

namespace App\Models\Clients;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{


  protected $guarded =  [];


    public function employees()
    {
        return $this->hasMany('App\Models\Employees\Employee');
    }
    public function tasks()
    {
        return $this->hasMany('App\Models\Tasks\Task');
    }
}
