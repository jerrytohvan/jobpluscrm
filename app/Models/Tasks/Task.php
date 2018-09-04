<?php

namespace App\Models\Tasks;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    protected $guarded = [];
    
    public function company()
    {
        return $this->belongsTo('App\Models\Clients\Company');
    }
}
