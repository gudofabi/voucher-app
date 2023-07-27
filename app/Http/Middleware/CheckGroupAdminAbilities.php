<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Silber\Bouncer\BouncerFacade as Bouncer;
use Silber\Bouncer\Database\Role;

class CheckGroupAdminAbilities
{
    public function handle(Request $request, Closure $next)
    {
        $groupAdminRole = Role::where('name', 'GroupAdmin')->first();

        if (!$groupAdminRole) {
            // Handle the case where the role doesn't exist
            return response()->json(['error' => 'GroupAdmin role not found'], 404);
        }

        $abilities = $groupAdminRole->abilities->pluck('name');

        foreach ($abilities as $ability) {
            if (!Bouncer::can($ability)) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }
        }

        return $next($request);
    }
}
