<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    public function definition(): array
    {
        return [
            'comment' => $this->faker->paragraph(),
            'rating' => $this->faker->numberBetween(1, 5),
        ];
    }
}