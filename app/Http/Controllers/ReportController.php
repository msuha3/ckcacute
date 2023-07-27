<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PatientVisits;
use App\Models\PCTSummary;
use App\Models\QuarterlyReport;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function quaterly(Request $request){
        $data = QuarterlyReport::all();
        return view("reports.quaterly", compact('data'));
         
    }

    public function quaterly_each($id){
        $report_data = QuarterlyReport::where('id', $id)->first();
        $pct_summary = PCTSummary::where('report_id', $id)->get();
        return view("reports.quaterly_each", compact('report_data','pct_summary'));
        
    }

    public function update_quaterly_report(Request $request){

        $quarterly_report = QuarterlyReport::where('id', $request->id)->first();
        
        $quarterly_report->treatments_wo_dverse = $request->treatments_wo_dverse;
        $quarterly_report->treatments_w_dverse = $request->treatments_w_dverse;
        $quarterly_report->bloodpressure_change = $request->bloodpressure_change;
        $quarterly_report->temperature_change = $request->temperature_change;
        $quarterly_report->blood_loss = $request->blood_loss;
        $quarterly_report->clotted_blood_lines = $request->clotted_blood_lines;
        $quarterly_report->clotted_access = $request->clotted_access;
        $quarterly_report->power_outage = $request->power_outage;
        $quarterly_report->machine_system_failure = $request->machine_system_failure;
        $quarterly_report->machine_system_fluid_leak = $request->machine_system_fluid_leak;
        $quarterly_report->allergic_reaction = $request->allergic_reaction;
        $quarterly_report->Unable_ordered_outcome = $request->Unable_ordered_outcome;
        
        $quarterly_report->change_care_level = $request->change_care_level;
        $quarterly_report->adverse_events_other = $request->adverse_events_other;
        $quarterly_report->adverse_events_other = $request->adverse_events_other;
        $quarterly_report->flowsheets_audited = $request->flowsheets_audited;


        PCTSummary::where('report_id', $request->id)->delete();

        foreach($request->pct_name as $index => $pct_name){
            $pct_summary = new PCTSummary;
            $pct_summary->report_id = $request->id;
            $pct_summary->pct_name = $pct_name;
            $pct_summary->cpr_expiration = $request->cpr_expiration[$index];
            $pct_summary->dialysis_certification = $request->dialysis_certification[$index];
            $pct_summary->oph_orientation = $request->oph_orientation[$index];
            $pct_summary->annual_competency = $request->annual_competency[$index];
            $pct_summary->age_specific_competence = $request->age_specific_competence[$index];
            $pct_summary->performance_evaluations = $request->performance_evaluations[$index];
            $pct_summary->covid_vaccination_1st_dose = $request->covid_vaccination_1st_dose[$index];
            $pct_summary->covid_vaccination_2nd_dose = $request->covid_vaccination_2nd_dose[$index];
            $pct_summary->covid_vaccination_booster = $request->covid_vaccination_booster[$index];

            $pct_summary->save();
        }
        



        $quarterly_report->save();


        return redirect("/quaterly_each/$request->id")->with('msg', 'Report updated!');
        
    }

    public function generate(Request $request){
        
        $report_data['total_treatments'] = $report_data['cancelled'] = $report_data['hemo_modality'] = $report_data['cardiac_modality'] = $report_data['day_treatments'] = $report_data['night_treatments'] = $report_data['weekend_treatments'] = $report_data['holiday_treatments'] = $report_data['goal_meet_time'] = $report_data['goal_meet_uf'] = $report_data['cardiac_related'] = $report_data['infection_related'] = $report_data['surgery_related'] = $report_data['gi_related'] = $report_data['electrolyte_related'] = $report_data['sob_related'] = $report_data['physical_injury_related'] = $report_data['neural_related'] = $report_data['blood_transfusion_related'] = $report_data['respiratory_related'] = $report_data['other'] = 0;

        if($request->submit){
            $startDate = Carbon::createFromFormat('Y-m-d', $request->start_date);
            $endDate = Carbon::createFromFormat('Y-m-d', $request->end_date);

            $report_data['total_treatments'] = PatientVisits::whereBetween('created_at', [$startDate, $endDate])->count();
            $report_data['cancelled'] = PatientVisits::where('status','cancelled')->whereBetween('created_at', [$startDate, $endDate])->count();
            $report_data['hemo_modality'] = PatientVisits::where('modality','Hemo')->whereBetween('created_at', [$startDate, $endDate])->count();
            $report_data['cardiac_modality'] = PatientVisits::where('modality','Peritoneal')->whereBetween('created_at', [$startDate, $endDate])->count();
            $report_data['day_treatments'] = PatientVisits::whereNotNull('day')->whereBetween('created_at', [$startDate, $endDate])->count();
            $report_data['night_treatments'] = PatientVisits::whereNotNull('night_rate')->whereBetween('created_at', [$startDate, $endDate])->count();
            $report_data['weekend_treatments'] = PatientVisits::whereNotNull('weekend_rate')->whereBetween('created_at', [$startDate, $endDate])->count();
            $report_data['holiday_treatments'] = PatientVisits::whereNotNull('holiday_rate')->whereBetween('created_at', [$startDate, $endDate])->count();
            $report_data['goal_meet_time'] = PatientVisits::whereNotNull('gmt')->whereBetween('created_at', [$startDate, $endDate])->count();
            $report_data['goal_meet_uf'] = PatientVisits::whereNotNull('gmu')->whereBetween('created_at', [$startDate, $endDate])->count();

            $report_data['cardiac_related'] = PatientVisits::where('dx_code',1)->whereBetween('created_at', [$startDate, $endDate])->count();
            $report_data['infection_related'] = PatientVisits::where('dx_code',2)->whereBetween('created_at', [$startDate, $endDate])->count();
            $report_data['surgery_related'] = PatientVisits::where('dx_code',3)->whereBetween('created_at', [$startDate, $endDate])->count();
            $report_data['gi_related'] = PatientVisits::where('dx_code',4)->whereBetween('created_at', [$startDate, $endDate])->count();
            $report_data['electrolyte_related'] = PatientVisits::where('dx_code',5)->whereBetween('created_at', [$startDate, $endDate])->count();
            $report_data['sob_related'] = PatientVisits::where('dx_code',6)->whereBetween('created_at', [$startDate, $endDate])->count();
            $report_data['physical_injury_related'] = PatientVisits::where('dx_code',7)->whereBetween('created_at', [$startDate, $endDate])->count();
            $report_data['neural_related'] = PatientVisits::where('dx_code',8)->whereBetween('created_at', [$startDate, $endDate])->count();
            $report_data['blood_transfusion_related'] = PatientVisits::where('dx_code',9)->whereBetween('created_at', [$startDate, $endDate])->count();
            $report_data['respiratory_related'] = PatientVisits::where('dx_code',10)->whereBetween('created_at', [$startDate, $endDate])->count();
            $report_data['other'] = PatientVisits::where('dx_code',11)->whereBetween('created_at', [$startDate, $endDate])->count();




            return view("reports.generate", compact('report_data'));
        }else{
            return view("reports.generate", compact('report_data'));
        }

         
    }

}