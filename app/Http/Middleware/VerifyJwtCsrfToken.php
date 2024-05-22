<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyJwtCsrfToken
{

    public function handle(Request $request, Closure $next): Response
    {
        if (config('csrf.disable_csrf_check')) { // for testing through Swagger UI, this disables the csrf check,
            return $next($request);                   // but in production, this should be set to false
        }

        if (
            $request->cookie('X-XSRF-TOKEN')  !==
            auth()->payload()->get('X-XSRF-TOKEN')
        ) {
            return response(null, Response::HTTP_BAD_REQUEST);
        }

        return $next($request);

    }
}
