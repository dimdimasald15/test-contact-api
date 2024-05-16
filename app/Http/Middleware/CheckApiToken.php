<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('Authorization');
        echo $token; // Tampilkan nilai token dalam header
        if (!$token) {
            // return response()->json(['message' => 'Token not provided'], 401);
            return redirect('/login');
        }

        // Lakukan validasi token di sini, misalnya dengan memanggil API login
        return redirect('/admin/dashboard');
        // return $next($request);
    }
}
