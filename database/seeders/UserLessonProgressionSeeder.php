<?php

namespace Database\Seeders;

use App\Models\Lesson;
use App\Models\User;
use App\Models\UserLessonProgression;
use Illuminate\Database\Seeder;

class UserLessonProgressionSeeder extends Seeder
{
    public function run(): void
    {
        $lessons = Lesson::all();
        $users = User::take(2)->get();

        foreach ($users as $user) {
            foreach ($lessons as $lesson) {
                UserLessonProgression::create([
                    'user_id' => $user->id,
                    'lesson_id' => $lesson->id,
                    'completed' => rand(0, 1),
                ]);
            }
        }
    }
}
