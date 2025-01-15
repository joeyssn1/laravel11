<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Table>
 */
class TableFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tablenumber' => fake()->numberBetween(1, 100),
            'capacity' => fake()->numberBetween(1, 100),
            'status'=> fake()->randomElement(['available'],['unavailable'])
        ];
    }
}
