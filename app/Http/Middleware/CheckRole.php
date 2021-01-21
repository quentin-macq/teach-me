<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole {
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next) {
        if (auth()->user()->role !== 'professeur' && auth()->user()->role !== 'admin') {
            abort(403, 'This action is unauthorized.');
        }

        return $next($request);
    }
}
