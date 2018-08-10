<?php

namespace App\Models\Clients;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
  protected $fillable = [
      'name', 'address', 'email', 'telephone_no', 'fax_no', 'website', 'no_employees', 'industry', 'lead_source', 'telephone_no', 'transaction', 'description'
      ];

  public function employees()
  {
      return $this->hasMany('App\Models\Employees\Employee');
  }
  public function events()
  {
      return $this->belongsToMany('App\Models\Events\Event');
  }
}
