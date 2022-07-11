<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_id' => $this->faker->numberBetween(1, 10),
            'user_id' => '2',
            'quantity' => $this->faker->numberBetween(1, 5),
            'amount' => $this->faker->numberBetween(1, 20),
        ];
    }
}
