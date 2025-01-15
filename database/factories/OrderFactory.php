<?php

namespace Database\Factories;

use App\Models\Table;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $userIds; // Keep track of already used user IDs

        if (!$userIds) {
            $userIds = User::pluck('id')->toArray(); // Get all user IDs once
        }

        return [
            'user_id' => array_shift($userIds), // Assign a unique user ID
            'status' => $this->faker->randomElement(['paid', 'did not paid']),
        ];
    }
}