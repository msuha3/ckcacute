<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::insert(
            [
                'name'=>'Admin Admin',
                'email'=>'admin@app.com',
                'password'=>'$2y$10$k1GD49CGTPPpSkyEzUT4auoMjYW8/oA50ZAS6Q.S4ieHLj7toTGvG',
                'email_verified_at'=>now(),
                'role'=>'admin'
            ]
            );
        $this->call(
            [
                PatientTableSeeder::class,
                PatientVisitsTableSeeder::class,
                EmployeeTableSeeder::class
            ]
            );
    }
}
