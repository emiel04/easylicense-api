<?php

namespace App\Http\Controllers;

use App\Modules\Languages\LanguageService;
class LanguageController extends ApiServiceController
{
    public function __construct(LanguageService $service)
    {
        $this->service = $service;
    }

    public function getLang($langCode)
    {
        $langPath = $this->service->getLang($langCode);

        if (!$langPath) {
            return response()->json(['message' => 'Language not found'], 404);
        }

        return response()->file($langPath);
    }

}
