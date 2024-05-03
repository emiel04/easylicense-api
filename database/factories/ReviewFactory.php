<?php

namespace Database\Factories;

use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'rating' => $this->faker->numberBetween(1, 5),
            'grade' => $this->faker->numberBetween(0, 50),
            'content' => $this->faker->sentence(6),
        ];
    }
}
