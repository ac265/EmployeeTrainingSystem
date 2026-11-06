<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiTokenMiddleware
{
    public function handle(
        Request $request,
        Closure $next
    ): Response {

        $token = $request->bearerToken();

        $validToken = config('services.employee_api.token');

        if (
            empty($token) ||
            empty($validToken) ||
            !hash_equals($validToken, $token)
        ) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access.'
            ], 401);
        }

        return $next($request);
    }
}
