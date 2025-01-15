<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Menu>
 */
class MenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category = Category::all();
        
        return[
            'category_id' => $category->random()->id,
            'name' => $this->faker->sentence(2),
            'food_description' => $this->faker->sentence(6),
            'price' => $this->faker->numberBetween(1000, 2000)
        ];
    }
}
