<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyJwtCsrfToken
{

    public function handle(Request $request, Closure $next): Response
    {
        if (
            $request->cookie('X-XSRF-TOKEN')  !==
            auth()->payload()->get('X-XSRF-TOKEN')
        ) {
            return response(null, Response::HTTP_BAD_REQUEST);
        }

        return $next($request);

    }
}
