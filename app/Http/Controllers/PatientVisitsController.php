<?php

namespace App\Http\Controllers;

use App\Models\PatientVisits;
use App\Models\Patients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientVisitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $patientVisits = PatientVisits::with('patient')->orderBy('id', 'desc');
        
        // Add a condition to restrict visits for tech users
        if (Auth::user()->role === 'tech') {
            $patientVisits = $patientVisits->where('user_id', Auth::user()->id);
        }
        
        // Apply additional filters if required
        if ($request->has('hospital_id') && $request->hospital_id != "") {
            $patientVisits = $patientVisits->where("hospital_id", $request->hospital_id);
        }
        if ($request->has('month') && $request->get('month') != "") {
            $date = date("Y-m", strtotime($request->month));
            $patientVisits = $patientVisits->where("date", "like", "%".$date."%");
        }

        $patientVisits = $patientVisits->get();

        return view("patientVisits.index", ['patientVisits' => $patientVisits]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("patientVisits.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $this->requestValidation($request);
    $requestData = $request->all();
    $requestData['status'] = 'completed'; // Set the default status to 'completed'
    PatientVisits::create($requestData);
    return redirect("patientVisits");
}

    /**
     * Display the specified resource.
     *
     * @param  int  $patientId
     * @return \Illuminate\Http\Response
     */
    public function show($patientId)
    {
        Patients::findOrFail($patientId);

        return view("patientVisits.index", ["patientVisits" => PatientVisits::where("patient_id", $patientId)->get()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PatientVisits  $patientVisit
     * @return \Illuminate\Http\Response
     */
    public function edit(PatientVisits $patientVisit)
    {
        return view("patientVisits.edit", compact("patientVisit"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PatientVisits  $patientVisit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PatientVisits $patientVisit)
    {
        $this->requestValidation($request);
        $patientVisit->update($request->all());
        return redirect("patientVisits/".$patientVisit->id."/edit")
            ->with("success", "Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PatientVisits  $patientVisit
     * @return \Illuminate\Http\Response
     */
    public function destroy(PatientVisits $patientVisit)
    {
        $patientVisit->delete();
        return redirect("patientVisits")->with("success", "PatientVisits record is removed");
    }

    /**
     * Perform request validation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function requestValidation(Request $request)
    {
        $request->validate([
            'patient_id' => 'required',
            'hospital_id' => 'required',
            'date' => 'required',
            'room' => 'required',
            'dx_code' => 'required',
            'gmt' => 'required',
            'gmu' => 'required'
        ]);
    }
}
