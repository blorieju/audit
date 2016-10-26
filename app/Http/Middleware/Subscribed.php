<?php

namespace App\Http\Middleware;

use Closure;

class Subscribed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->user()->subscribed('main')) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'confirmation_type' => 'error',
                    'message' => 'Unauthorized'
                ],401);
            }
        } else {
            return response()->json([
                'confirmation_type' => 'success',
                'message' => 'You can access plans'
            ],200);
        }

        return $next($request);
    }
}
