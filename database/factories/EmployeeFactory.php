<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
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
                'doj'=>$this->faker->date("d/m/Y"),
                'dob'=>$this->faker->date("d/m/Y"),
                'role'=>$this->faker->randomElement(array("worker","lab attendant","misc")),
                'salary'=>rand(5000,8000),
                'status'=>1
            ];
    }
}
