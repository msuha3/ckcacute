<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PatientVisits;
class PatientVisitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        PatientVisits::factory()->count(800)->create();
    }
}
