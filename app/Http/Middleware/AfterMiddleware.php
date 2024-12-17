<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;

class AfterMiddleware
{
    /**
     * Handle an incoming request and modify the response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Pass the request to the next middleware or controller
        $response = $next($request);

        // Check if the response is an instance of Response
        if ($response instanceof Response) {
            // Remove specific cookies by setting them with expired timestamps
            $response->headers->setCookie(
                new Cookie(
                    'XSRF-TOKEN', // Name of the cookie
                    '',           // Set an empty value
                    time() - 3600, // Expire immediately by setting a past timestamp
                    '/',           // Path
                    null,          // Domain
                    true,          // Secure
                    true,          // HttpOnly
                    true,          // Raw
                    Cookie::SAMESITE_STRICT // SameSite policy
                )
            );
        }

        return $response;
    }
}
