<?php

namespace App\Models\Fields;

use App\Models\Fields\Field;

class FieldService
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  Array $array
     * @return \Illuminate\Http\Response
     */
    public function storeField($array)
    {
        return Field::Create([
            'interest_id' => $array['interest_id'],
            'field_name' => $array['field_name'],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Like $like
     * @param  Array  $array
     * @return \Illuminate\Http\Response
     */
    public function updateField($id, $array)
    {
        $field = Field::find($id);
        foreach ($array as $key => $value) {
           $field->$key = $value;
        }
        $field->save();
        return $field;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Like  $like
     * @return \Illuminate\Http\Response
     */
    public function destroyField($id)
    {
        Field::findOrFail($id)->delete();
        return 204;
    }

}
