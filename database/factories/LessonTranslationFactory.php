<?php

namespace Database\Factories;

use App\Models\LessonTranslation;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LessonTranslation>
 */
class LessonTranslationFactory extends Factory
{

    protected $model = LessonTranslation::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'lesson_id' => $this->faker->numberBetween(0,3),
            'language_id' => $this->faker->numberBetween(0,1),
        ];
    }
}
