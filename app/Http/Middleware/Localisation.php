<?php

namespace App\Http\Middleware;

use App\Modules\Core\Helper\LanguageHelper;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Localisation
{
    public function handle(Request $request, Closure $next): Response
    {
        $preferredLanguages = $request->getLanguages();

        if (empty($preferredLanguages)) {
            $preferredLanguages = ['en'];
        }

        foreach ($preferredLanguages as $locale) {
            $locale = LanguageHelper::getLanguageOnly($locale);
            if (LanguageHelper::isSupportedLocale($locale)) {
                app()->setLocale($locale);
                return $next($request);
            }
        }
        return response()->json(['message' => 'Language not supported'], Response::HTTP_BAD_REQUEST);
    }
}
