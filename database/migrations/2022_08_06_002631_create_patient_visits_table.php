<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_visits', function (Blueprint $table) {
            $table->id();
            
            $table->text('patient_id')->nullable();
            $table->text('date')->nullable();
            $table->text('room')->nullable();
            $table->text('invoice_number')->nullable();
            $table->text('tx_number')->nullable();
            $table->text('dx_code')->nullable();
            $table->text('gmt')->nullable();
            $table->text('gmu')->nullable();
            $table->text('modality')->nullable();
            $table->text('time_start')->nullable();
            $table->text('time_end')->nullable();
            $table->text('signature')->nullable();
            $table->text('night_rate')->nullable();
            $table->text('holiday_rate')->nullable();
            $table->text('weekend_rate')->nullable();
            $table->text('day')->nullable();
            $table->text('amount')->nullable();
            $table->text('comment')->nullable();

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
        Schema::dropIfExists('patient_visits');
    }
}
