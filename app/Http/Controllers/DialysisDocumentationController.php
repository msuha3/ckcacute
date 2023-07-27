<?php

namespace App\Http\Controllers;

use App\Models\DialysisDocumentation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DialysisDocumentationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($patient_id, Request $request)
    {
        
        //
        $array = 
        [
            'patient_id'=>$patient_id,
            'cpr_expiration'=>$request->cpr_expiration,
            'ac'=>$request->ac,
            'dc'=>$request->dc,
            'asc'=>$request->asc,
            'pe'=>$request->pe,
            'cv1'=>$request->cv1,
            'cv2'=>$request->cv2,
            'cvb'=>$request->cvb,
            'oph'=>$request->oph,
            'added_by'=>Auth::id(),
            'created_at'=>now()
        ];
        if(DialysisDocumentation::where('patient_id', $patient_id)->exists()){
            DialysisDocumentation::where('patient_id', $patient_id)->
            update($array);
        }else{
            DialysisDocumentation::insert($array);
                }

                return redirect("patients/DialysisDocumentation/".$patient_id)
                ->with("success","Dialysis Documentation Updated");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DialysisDocumentation  $dialysisDocumentation
     * @return \Illuminate\Http\Response
     */
    public function show($patient_id)
    {
        //dsf
        return view("patientVisits.dialysisDocumentation", ["dialysisDocumentation"=>DialysisDocumentation::where("patient_id", $patient_id)->first(), "patient_id"=>$patient_id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DialysisDocumentation  $dialysisDocumentation
     * @return \Illuminate\Http\Response
     */
    public function edit(DialysisDocumentation $dialysisDocumentation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DialysisDocumentation  $dialysisDocumentation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DialysisDocumentation $dialysisDocumentation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DialysisDocumentation  $dialysisDocumentation
     * @return \Illuminate\Http\Response
     */
    public function destroy(DialysisDocumentation $dialysisDocumentation)
    {
        //
    }
}
