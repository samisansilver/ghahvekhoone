<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class placeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->locale(),
            'type' => rand(1,2),
            'description' => fake()->text(50),
            'country' => fake()->country(),
            'city' => fake()->city(),
            'address' => fake()->address(),
            'latitude' => fake()->latitude(),
            'longitude' => fake()->latitude(),
            'phone' => fake()->phoneNumber(),
            'instagram' => fake()->url()
        ];
    }
}
