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
            'title' => function (array $attributes) {
                return $this->generateSentence($attributes['language_code'], 'title', $attributes['lesson_id']);
            },
            'content' => function (array $attributes) {
                return $this->generateSentence($attributes['language_code'], 'content', $attributes['lesson_id']);
            },
            'lesson_id' => $this->faker->numberBetween(0,3),
        ];
    }

    private function generateSentence($languageCode, $type, $lessonId): string
    {
        if ($type == 'title') {
            return $languageCode == 'nl' ? 'Dutch Title ' . $lessonId : 'English Title ' . $lessonId;
        } else {
            return $languageCode == 'nl' ? 'Dutch Content ' . $lessonId : 'English Content ' . $lessonId;
        }
    }
}
