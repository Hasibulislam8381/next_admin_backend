<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApplyMailSettings
{
    public function handle(Request $request, Closure $next)
    {
        applyMailSettings();

        return $next($request);
    }
}
