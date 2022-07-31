<?php

namespace App\Http\Middleware;

use App\Constants\TokenConstant;
use App\Helpers\ResponseHelper;
use Closure;
use Illuminate\Http\Request;

class AdminMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function handle(Request $request, Closure $next) {
        if (auth()->user()->tokenCan(TokenConstant::AUTH_ADMIN)) return $next($request);
        return ResponseHelper::response(null, "Unauthenticated", 401);
    }
}
