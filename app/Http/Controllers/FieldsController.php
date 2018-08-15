<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Fields\Field;
use App\Models\Fields\FieldService;
use Illuminate\Http\Request;

class FieldsController extends Controller
{
    //
    public function __construct(FieldService $fieldSvc)
    {
        $this->svc = $fieldSvc;
        // $this->middleware('auth');
    }
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
    public function store(Field $field)
    {
        //
        return $this->svc->storeField(request()->all());
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
    public function update($id)
    {
        //
        return $this->svc->updateField($id, request()->all());
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
        return $this->svc->destroyField($id);
    }
}
