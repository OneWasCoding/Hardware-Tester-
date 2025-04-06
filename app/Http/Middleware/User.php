<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class User
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->user()->role=='user'){
            return $next($request);
            return redirect()->route('home')->with('success', 'Password updated successfully');
        }

       abort(403, 'Unauthorized action.');
        // return response()->json(['message' => 'Unauthorized'], 403);
        return redirect()->route('login')->with('error', 'Unauthorized action.');
    }
    }

