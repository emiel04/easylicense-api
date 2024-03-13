<?php

namespace Database\Seeders;

use App\Models\Lesson;
use App\Models\LessonTranslation;
use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    public function run(): void
    {
        // Create 50 lessons
        $lessons = Lesson::factory()->count(50)->create();
        // For each lesson, create a translation
        $lessons->each(function (Lesson $lesson) {
            LessonTranslation::factory()->create(['lesson_id' => $lesson->id, 'language_id' => 1]); // Dutch
            LessonTranslation::factory()->create(['lesson_id' => $lesson->id, 'language_id' => 2]); // English
        });
    }
}
