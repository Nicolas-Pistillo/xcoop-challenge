<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Exception;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWTMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try { 
            $client = JWTAuth::parseToken()->authenticate(); 
            $request->merge(compact('client'));
        } 
        catch (Exception $e) {

            $errorMessage = 'Authorization Token not found';

            if ($e instanceof TokenInvalidException) {
                $errorMessage = 'Token is Invalid';
            }

            if ($e instanceof TokenExpiredException) {
                $errorMessage = 'Token is Expired';
            }

            return response()->json(['status' => $errorMessage]);

        }

        return $next($request);
    }
}
