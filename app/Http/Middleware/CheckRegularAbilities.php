<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Bouncer;
use Silber\Bouncer\Database\Role;

class CheckRegularAbilities
{
    public function handle(Request $request, Closure $next)
    {
        $regularRole = Role::where('name', 'Regular')->first();

        if (!$regularRole) {
            return response()->json(['error' => 'Regular role not found'], 404);
        }

        $abilities = $regularRole->abilities->pluck('name');

        foreach ($abilities as $ability) {
            if (!Bouncer::can($ability)) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }
        }

        return $next($request);
    }
}