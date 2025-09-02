<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctor>
 */
class DoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'major_id'=>fake()->numberBetween(1,5),
            'address'=>fake()->address(),
            'price'=>fake()->randomElement([200,250,300,350,400]),
            'user_id'=>fake()->unique()->numberBetween(1,25),
        ];
    }
}
