<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PatientVisitsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return
            [
                'patient_id'=>rand(1,200),
                'date'=>$this->faker->date("d/m/Y"),
                'room'=>rand(1,10),
                'invoice_number'=>$this->faker->randomDigit,
                'tx_number'=>$this->faker->randomDigit,
                'dx_code'=>rand(1,13),
                'gmt'=>["Y", "N"][rand(0,1)],
                'gmu'=>$this->faker->randomElement( array ("Y", "N")),
                'modality'=>"Hemo",
                'time_start'=>$this->faker->unixTime($max = 'now'),
                'time_end'=>$this->faker->unixTime($max = 'now'),
                'signature'=>$this->faker->text(20),
                'night_rate'=>rand(200,500),
                'holiday_rate'=>rand(200,500),
                'weekend_rate'=>rand(200,500),
                'day'=>$this->faker->dayOfWeek($max = 'now') ,
                'amount'=>rand(500,1000),
                'comment'=>$this->faker->text(200),
                'created_at'=>now()
            ];
    }
}
