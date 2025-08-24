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
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone'=>fake()->unique()->phoneNumber(),
            'adress'=>fake()->address(),
            'dates'=>strtolower(fake()->dateTimeBetween('now', '+1 week')->format('D-d/M-Y')),
            'price'=>fake()->randomElement([200,250,300,350,400]),
            'visitors'=>fake()->numberBetween(0,10),
            'user_id'=>fake()->unique()->numberBetween(1,25),
        ];
    }
}
