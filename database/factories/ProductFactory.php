<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'price' => $this->faker->numberBetween(1000, 999999),
            'description' => $this->faker->sentence(20),
            'category_id' => Category::inRandomOrder()->first()->id,
            'image' => null,
            'stok' => $this->faker->numberBetween(1, 100)
        ];
    }
}
