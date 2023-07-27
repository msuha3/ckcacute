<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\QuarterlyReport;
use App\Models\PatientVisits;
use Carbon\Carbon;

class ReportCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This cron job will generate quarterly report';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        

        $firstOfQuarter = Carbon::create(Carbon::now())->firstOfQuarter();
        $endOfQuarter = Carbon::create(Carbon::now())->endOfQuarter();


        $startDate = $firstOfQuarter;
        $endDate = $endOfQuarter;

        $quarterly_report = new QuarterlyReport;
        $quarterly_report->date_range = date('d M Y',strtotime($firstOfQuarter))." - ".date('d M Y',strtotime($endOfQuarter));
        $quarterly_report->total = PatientVisits::whereBetween('created_at', [$startDate, $endDate])->count();
        $quarterly_report->cancelled = PatientVisits::where('status','cancelled')->whereBetween('created_at', [$startDate, $endDate])->count();
        $quarterly_report->hemodialysis = PatientVisits::where('modality','Hemo')->whereBetween('created_at', [$startDate, $endDate])->count();
        $quarterly_report->peritoneal = PatientVisits::where('modality','Peritoneal')->whereBetween('created_at', [$startDate, $endDate])->count();
        $quarterly_report->day_treatments = PatientVisits::whereNotNull('day')->whereBetween('created_at', [$startDate, $endDate])->count();
        $quarterly_report->night_treatments = PatientVisits::whereNotNull('night_rate')->whereBetween('created_at', [$startDate, $endDate])->count();
        $quarterly_report->weekend_treatments = PatientVisits::whereNotNull('weekend_rate')->whereBetween('created_at', [$startDate, $endDate])->count();
        $quarterly_report->holiday_treatments = PatientVisits::whereNotNull('holiday_rate')->whereBetween('created_at', [$startDate, $endDate])->count();
        $quarterly_report->prescribed_time_goal = PatientVisits::whereNotNull('gmt')->whereBetween('created_at', [$startDate, $endDate])->count();
        $quarterly_report->prescribed_filtration_goal = PatientVisits::whereNotNull('gmu')->whereBetween('created_at', [$startDate, $endDate])->count(); 
        $quarterly_report->cardiac_related = PatientVisits::where('dx_code',1)->whereBetween('created_at', [$startDate, $endDate])->count();
        $quarterly_report->fever_related = PatientVisits::where('dx_code',2)->whereBetween('created_at', [$startDate, $endDate])->count();
        $quarterly_report->surgery_related = PatientVisits::where('dx_code',3)->whereBetween('created_at', [$startDate, $endDate])->count();
        $quarterly_report->gi_related = PatientVisits::where('dx_code',4)->whereBetween('created_at', [$startDate, $endDate])->count();
        $quarterly_report->electrolyte_related = PatientVisits::where('dx_code',5)->whereBetween('created_at', [$startDate, $endDate])->count();
        $quarterly_report->sob_related = PatientVisits::where('dx_code',6)->whereBetween('created_at', [$startDate, $endDate])->count();
        $quarterly_report->injury_related = PatientVisits::where('dx_code',7)->whereBetween('created_at', [$startDate, $endDate])->count();
        $quarterly_report->neural_related = PatientVisits::where('dx_code',8)->whereBetween('created_at', [$startDate, $endDate])->count();
        $quarterly_report->transfusion_related = PatientVisits::where('dx_code',9)->whereBetween('created_at', [$startDate, $endDate])->count();
        $quarterly_report->respiratory_related = PatientVisits::where('dx_code',10)->whereBetween('created_at', [$startDate, $endDate])->count();
        $quarterly_report->other = PatientVisits::where('dx_code',11)->whereBetween('created_at', [$startDate, $endDate])->count();
 

        $quarterly_report->save();

    }
}
