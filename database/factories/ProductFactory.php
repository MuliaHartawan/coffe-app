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
            'title' => $this->faker->asciify('product-****'),
            'image' => $this->faker->imageUrl(640, 480, 'products', true),
            'price' => $this->faker->numberBetween(1,10),
            'stock' => $this->faker->numberBetween(1,20),
        ];
    }
}
