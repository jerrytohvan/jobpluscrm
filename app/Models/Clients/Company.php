<?php

namespace App\Models\Clients;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Company extends Model
{
    use LogsActivity;

    protected $guarded = [];
    protected static $logAttributes = ["*"];

    public function employees()
    {
        return $this->hasMany('App\Models\Employees\Employee');
    }
    public function tasks()
    {
        return $this->hasMany('App\Models\Tasks\Task');
    }
    public function candidates()
    {
        return $this->hasMany('App\Models\Clients\Candidate');
    }
    public function events()
    {
        return $this->hasMany('App\Models\Tasks\Task');
    }
    public function comments()
    {
        return $this->hasMany('App\Models\Comments\Comment');
    }
    public function posts()
    {
        return $this->hasMany('App\Models\Posts\Post');
    }

    public function files()
    {
        return $this->morphMany('App\Models\Attachments\Attachment', 'attachable');
    }

    public function collaborators()
    {
        return $this->belongsToMany('App\Models\Users\User', 'user_company')->using('App\Models\Users\UserCompany');
    }
    public function jobs()
    {
        return $this->hasMany('App\Models\Jobs\Job');
    }

	public function tasks()
	{
		return $this->hasMany('App\Models\Tasks\Task');
	}}
