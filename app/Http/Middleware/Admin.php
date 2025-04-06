<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->user()->role=='admin'){
            return $next($request);
            return redirect()->route('user.index')->with('success', 'Password updated successfully');
        }

       abort(403, 'Unauthorized action.');
        // return response()->json(['message' => 'Unauthorized'], 403);
        return redirect()->route('home')->with('error', 'Unauthorized action.');
    }
}
