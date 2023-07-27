<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePCTSummariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_c_t_summaries', function (Blueprint $table) {
            $table->id();
            $table->biginteger('report_id')->nullable();
            $table->string('pct_name')->nullable();
            $table->string('cpr_expiration')->nullable();
            $table->string('dialysis_certification')->nullable();
            $table->string('oph_orientation')->nullable();
            $table->string('annual_competency')->nullable();
            $table->string('age_specific_competence')->nullable();
            $table->string('performance_evaluations')->nullable();
            $table->string('covid_vaccination_1st_dose')->nullable();
            $table->string('covid_vaccination_2nd_dose')->nullable();
            $table->string('covid_vaccination_booster')->nullable();
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
        Schema::dropIfExists('p_c_t_summaries');
    }
}
