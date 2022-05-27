<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'price' => $this->faker->randomFloat(2, 100, 2000),
            'quantity' => $this->faker->numberBetween(0, 100),
            'seller_id' => $this->faker->numberBetween(0, 10),
        ];
    }
}
