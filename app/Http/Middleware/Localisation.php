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
        $lang = $request->header('Accept-Language');
        if (!$lang) {
            $lang = 'en';
        }


        if (in_array($lang, ['en', 'nl'])) {
            App::setLocale($lang);
            return $next($request);
        } else {
            return response()->json(['message' => 'Language not supported'], Response::HTTP_BAD_REQUEST);
        }


    }
}
