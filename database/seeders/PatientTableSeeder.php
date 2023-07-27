<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Patients;
class PatientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Patients::factory()->count(200)->create();
    }
}
