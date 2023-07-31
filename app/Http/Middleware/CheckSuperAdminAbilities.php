<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Bouncer;
use Silber\Bouncer\Database\Role;

class CheckSuperAdminAbilities
{
    public function handle(Request $request, Closure $next)
    {
        $superAdminRole = Role::where('name', 'SuperAdmin')->first();

        if (!$superAdminRole) {
            return response()->json(['error' => 'SuperAdmin role not found'], 404);
        }

        $abilities = $superAdminRole->abilities->pluck('name');

        foreach ($abilities as $ability) {
            if (!Bouncer::can($ability)) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }
        }

        return $next($request);
    }
}