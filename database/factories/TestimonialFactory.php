<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Testimonial;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Testimonial>
 */
class TestimonialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'name' => fake()->name(),
            'message' => fake()->sentence(12),
            'rating' => fake()->numberBetween(4, 5),
        ];
    }
}
