<?php


namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Closure;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->admin) {
            return $next($request);
        }
        if (auth()->check() && !auth()->user()->admin) {
            return response(null, RESPONSE::HTTP_FORBIDDEN);
        }

        return response(null, Response::HTTP_UNAUTHORIZED);
    }

}
