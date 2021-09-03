<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param string $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        $roles = [
          'auth' => 0,
          'admin' => 1,
          'super_admin' => 2,
        ];

        $roleId = $roles[$role] ?? 1;

        if (Auth::check() && Auth::user()->role >= $roleId) {

            return $next($request);
        }

        return abort(404);
    }
}
