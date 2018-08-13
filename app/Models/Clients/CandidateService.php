<?php

namespace App\Models\Clients;

use Illuminate\Http\Request;
use App\Models\Clients\Candidate;

class CandidateService
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  Array $array
     * @return \Illuminate\Http\Response
     */
    public function storeCandidate($array)
    {
        return Candidate::Create([
            'name' => $array['name'],
            'email' => $array['email'],
            'handphone' => $array['handphone'],
            'working_experience' => $array['working_experience'],
            'graduation_year'=>$array['graduation_year'],
            'interest_id' => $array['interest_id'],
            'type' => $array['type'],
            'field_id' => $array['field_id']
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Like $like
     * @param  Array  $array
     * @return \Illuminate\Http\Response
     */
    public function updateCandidate($id, $array)
    {
        $candidate = Candidate::find($id);
        foreach ($array as $key => $value) {
            $candidate->$key = $value;
        }
        $candidate->save();
        return $candidate;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Like  $like
     * @return \Illuminate\Http\Response
     */
    public function destroyCandidate($id)
    {
        Candidate::findOrFail($id)->delete();
        return 204;
    }

}
