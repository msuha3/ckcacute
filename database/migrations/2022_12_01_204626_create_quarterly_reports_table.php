<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuarterlyReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quarterly_reports', function (Blueprint $table) {
            
            $table->id();
            $table->double('total')->nullable();
            $table->double('cancelled')->nullable();
            $table->double('hemodialysis')->nullable();
            $table->double('peritoneal')->nullable();
            $table->double('day_treatments')->nullable();
            $table->double('night_treatments')->nullable();
            $table->double('weekend_treatments')->nullable();
            $table->double('holiday_treatments')->nullable();
            $table->double('prescribed_time_goal')->nullable();
            $table->double('prescribed_filtration_goal')->nullable();
            $table->double('cardiac_related')->nullable();
            $table->double('fever_related')->nullable();
            $table->double('surgery_related')->nullable();
            $table->double('gi_related')->nullable();
            $table->double('electrolyte_related')->nullable();
            $table->double('sob_related')->nullable();
            $table->double('injury_related')->nullable();
            $table->double('neural_related')->nullable();
            $table->double('transfusion_related')->nullable();
            $table->double('respiratory_related')->nullable();
            $table->double('other')->nullable();
            $table->double('treatments_wo_dverse')->nullable();
            $table->double('treatments_w_dverse')->nullable();
            $table->double('bloodpressure_change')->nullable();
            $table->double('temperature_change')->nullable();
            $table->double('blood_loss')->nullable();
            $table->double('clotted_blood_lines')->nullable();
            $table->double('clotted_access')->nullable();
            $table->double('power_outage')->nullable();
            $table->double('machine_system_failure')->nullable();
            $table->double('machine_system_fluid_leak')->nullable();
            $table->double('allergic_reaction')->nullable();
            $table->double('change_care_level')->nullable();
            $table->double('Unable_ordered_outcome')->nullable();
            $table->double('adverse_events_other')->nullable();
            $table->double('flowsheets_audited')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quarterly_reports');
    }
}
