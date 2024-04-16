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
            ['language_code' => 'nl', 'language_name' => 'Nederlands', 'language_name_native' => 'Nederlands'],
            ['language_code' => 'en', 'language_name' => 'Engels', 'language_name_native' => 'English'],
        ];

        foreach ($languages as $l) {
            $language = new Language();
            $language->language_code = $l['language_code'];
            $language->language_name = $l['language_name'];
            $language->language_name_native = $l['language_name_native'];
            $language->save();
        }
    }
}
