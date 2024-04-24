<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
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
            if (in_array($locale, ['en', 'nl'])) {
                app()->setLocale($locale);
                return $next($request);
            }
        }
        return response()->json(['message' => 'Language not supported'], Response::HTTP_BAD_REQUEST);
    }
}
