<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        Review::factory()
            ->count(1)
            ->create(['user_id' => 1]);
    }
}
