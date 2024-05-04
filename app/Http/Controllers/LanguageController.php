<?php

namespace App\Http\Controllers;

use App\Modules\Languages\LanguageService;
class LanguageController extends ApiServiceController
{
    public function __construct(LanguageService $service)
    {
        $this->service = $service;
    }

}
