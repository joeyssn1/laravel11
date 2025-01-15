<?php

namespace Database\Factories;

use App\Models\Menu;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderDetail>
 */
class OrderDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $order = Order::all();
        $menu = Menu::all();
        return [
            'order_id' =>$order->random()->id, 
            'menu_id' => $menu->random()->id,   
            'quantity' => $this->faker->numberBetween(1, 10),
            'subtotal' => $this->faker->numberBetween(100000, 200000) * $this->faker->numberBetween(1, 10),
        ];
    }
}
