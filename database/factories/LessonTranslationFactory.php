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
        $englishContent = '<h2 class="text-xl">English <strong>Content</strong></h2><p style="text-align: center"><s>HELLO THIS IS MY CONTENT</s></p><hr class="my-4"><ol class="list-decimal ml-4 leading-normal"><li class="list-item leading-4"><p><img src="https://picsum.photos/200/300">item</p></li><li class="list-item leading-4"><p>item</p></li><li class="list-item leading-4"><p>item</p></li></ol>';
        $dutchContent = '<h2 class="text-xl">Nederlandse <strong>Content</strong></h2><p style="text-align: center"><s>HALLO DIT IS MIJN COOLE CONTENT</s></p><hr class="my-4"><ol class="list-decimal ml-4 leading-normal"><li class="list-item leading-4"><p><img src="https://picsum.photos/200/300">artikel</p></li><li class="list-item leading-4"><p>artikel</p></li><li class="list-item leading-4"><p>artikel</p></li></ol>';
        if ($type == 'title') {
            return $languageCode == 'nl' ? 'Dutch Title ' . $lessonId : 'English Title ' . $lessonId;
        } else {
            return $languageCode == 'nl' ? $dutchContent: $englishContent;
        }
    }
}
