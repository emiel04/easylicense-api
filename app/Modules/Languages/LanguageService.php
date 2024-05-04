<?php

namespace App\Modules\Languages;

use App\Models\Language;
use App\Modules\Core\Services\Service;

class LanguageService extends Service
{
    protected array $fields = ['language_code', 'language_name', 'language_native_name'];
    protected array $rules =
        [
            'language_code' => 'required',
            'language_name' => 'required',
            'language_native_name' => 'required'
        ];
    protected string $searchField = 'language_code';
    protected bool $isTranslatable = false;
    protected $model = Language::class;
    protected function getRelationFields(): array
    {
        return [
        ];
    }

    public function getLang($langCode)
    {
        $language = $this->model->where('language_code', $langCode)->first();

        if (!$language) {
            return null;
        }

        $filePath = lang_path("{$langCode}/translations.json");

        if (file_exists($filePath)) {
            return $filePath;
        }

        return null;
    }


    public function __construct(Language $model)
    {
        parent::__construct($model);
    }
}
