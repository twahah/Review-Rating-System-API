<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GigFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(4),
            'slug' => $this->faker->slug(),
            'description' => $this->faker->paragraphs(3, true),
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'is_active' => $this->faker->boolean(90),
        ];
    }
}
