<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Fields\Field;
use Illuminate\Http\Request;

class FieldsController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $fields = Field::orderBy('id', 'asc')->get();

        // load the view and pass the employees
        return $fields;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $field = new Field;
        $field->id = $request->id;
        $field->interest_id = $request->interest_id;
        $field->field_name = $request->field_name;
        $field->save();
        return $field;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $field = Field::find($id);
        return $field;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $field = Field::find($id);
        $field->interest_id = $request->interest_id;
        $field->field_name = $request->field_name;
        $field->update();
        return $field;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Field::findOrFail($id)->delete();
        return 204;
    }
}
