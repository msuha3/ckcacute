<?php

namespace App\Http\Controllers;

use App\Models\Patients;
use Illuminate\Http\Request;

class PatientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $patients = Patients::orderBy('id', 'desc')->get();
        return view("patients.index", ['patients' => $patients]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("patients.create");
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
        $this->requestValidation($request);
        Patients::create($request->all());
        return redirect("patients");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patients  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patients $patient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Patients  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Patients $patient)
    {
        //
        return view("patients.edit", compact("patient"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patients  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patients $patient)
    {
        //
        $this->requestValidation($request);
        $patient->update($request->all());
        return redirect("patients/".$patient->id."/edit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patients  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patients $patient)
    {
        //
        $patient->delete();
        return redirect("patients")->with("success", "Patients record is removed");
    }


    public function requestValidation(Request $request)
    {
        $request->validate([
            'account_no' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
        ]);
    }
}
