<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'category_id' => Category::factory(),
            'price' => fake()->numberBetween(10000, 5000000),
            'quantity' => fake()->numberBetween(1, 100),
        ];
    }
}