<?php

namespace Database\Seeders;

use App\Models\Lesson;
use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    public function run(): void
    {
        // Create 50 lessons
        $lessons = Lesson::factory()->count(50)->create();

        // For each lesson, create a translation
        $lessons->each(function (Lesson $lesson) {
            \App\Models\LessonTranslation::factory()->create(['lesson_id' => $lesson->id]);
        });
    }
}
