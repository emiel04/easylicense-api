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
                return $this->generateSentence($attributes['language_id'], 'title', $attributes['lesson_id']);
            },
            'content' => function (array $attributes) {
                return $this->generateSentence($attributes['language_id'], 'content', $attributes['lesson_id']);
            },
            'lesson_id' => $this->faker->numberBetween(0,3),
        ];
    }

    private function generateSentence($languageId, $type, $lessonId): string
    {
        if ($type == 'title') {
            return $languageId == 1 ? 'Dutch Title ' . $lessonId : 'English Title ' . $lessonId;
        } else {
            return $languageId == 1 ? 'Dutch Content ' . $lessonId : 'English Content ' . $lessonId;
        }
    }
}
