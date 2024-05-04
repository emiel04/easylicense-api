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
        $lessons = Lesson::factory()->count(5)->create();
        // For each lesson, create a translation
        $lessons->each(function (Lesson $lesson) {
            LessonTranslation::factory()->create(['lesson_id' => $lesson->id, 'language_code' => 'en']); // English
            LessonTranslation::factory()->create(['lesson_id' => $lesson->id, 'language_code' => 'nl']); // Dutch
        });

    }
}
