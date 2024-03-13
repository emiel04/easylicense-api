<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\Lesson;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    public function run(): void
    {
        $languages = [
            ['id' => 1, 'language_name' => 'Nederlands', 'language_name_native' => 'Nederlands', 'language_code' => 'nl'],
            ['id' => 2, 'language_name' => 'Engels', 'language_name_native' => 'English', 'language_code' => 'en'],
        ];

        foreach ($languages as $languageData) {
            $language = new Language();
            $language->id = $languageData['id'];
            $language->language_name = $languageData['language_name'];
            $language->language_name_native = $languageData['language_name_native'];
            $language->language_code = $languageData['language_code'];
            $language->save();
        }
    }
}
