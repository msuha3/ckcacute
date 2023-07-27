<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PatientsFactory extends Factory
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
                'first_name'=>$this->faker->firstName(),
                'last_name'=>$this->faker->lastName(),
                'address'=>$this->faker->address(),
                'contact'=>rand(1111111,9999999)
               
            ];
    }
}
