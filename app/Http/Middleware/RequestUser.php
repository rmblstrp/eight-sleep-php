<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestUser
{
    public function handle(Request $request, \Closure $next)
    {
        $userId = Auth::id();
        if (!empty($userId)) {
            $request->attributes->add(['userId' => $userId]);
        }
        return $next($request);
    }
}
