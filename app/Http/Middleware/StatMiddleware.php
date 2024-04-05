<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Path;
use Illuminate\Support\Facades\Log;

class StatMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        Log::alert($request->path);
        $path = new Path;
        $path->url = $request->path();
        $path->save();
        return $next($request);
    }
}
