<?php

namespace App\Models\Clients;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $guarded = [];
    public function employees()
    {
        return $this->hasMany('App\Models\Employees\Employee');
    }
    public function events()
    {
        return $this->belongsToMany('App\Models\Events\Event');
    }
    public function company()
    {
        return $this->belongsToMany('App\Models\Clients\Company');
    }

    public function interests()
    {
        return $this->hasMany('App\Models\Interests\Interest');
    }

    public function fields()
    {
        return $this->hasMany('App\Models\Fields\Field');
    }
}
