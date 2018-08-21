<?php

namespace App\Models\Fields;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    public $timestamps = false;
    protected $guarded = [];
    
    public function candidates()
    {
        return $this->belongsToMany('App\Models\Clients\Candidate');
    }

    public function interests()
    {
        return $this->belongsToMany('App\Models\Interests\Interest');
    }

}
