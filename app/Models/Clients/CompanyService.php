<?php

namespace App\Models\Clients;

use Illuminate\Http\Request;
use App\Models\Clients\Company;

class CompanyService
{

  /**
   * Store a newly created resource in storage.
   *
   * @param  Array $array
   * @return \Illuminate\Http\Response
   */
  public function storeCompany($array)
  {
      return Company::Create([
        'name' =>$array['name'],
        'address' => $array['address'],
        'email' => $array['email'],
        'telephone_no' => $array['telephone_no'],
        'fax_no' => $array['fax_no'],
        'website' => $array['website'],
        'no_employees' => $array['no_employees'],
        'industry' => $array['industry'],
        'lead_source' => $array['lead_source'],
        'transaction' => $array['transaction'],
        'description' => $array['description']
      ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  Like $like
   * @param  Array  $array
   * @return \Illuminate\Http\Response
   */
  public function updateCompany($id, $array)
  {
    $company = Company::find($id);
    foreach($array as $key => $value){
      $company->$key = $value;
    }
      $company->save();
      return $company;
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  Like  $like
   * @return \Illuminate\Http\Response
   */
  public function destroyCompany($id)
  {
    Company::findOrFail($id)->delete();
    return 204;
  }

}
