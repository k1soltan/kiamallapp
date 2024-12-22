<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RoleMiddleware
{
    public function handle($request, Closure $next, ...$roles)
{
    $user = Auth::user();

    if ($user) {
        // Check permissions first
        if ($user->hasAnyPermission($roles)) {
            Log::info('User has the required permission(s)', [
                'permissions' => $roles,
                'user_permissions' => $user->getAllPermissions()->pluck('name')->toArray(),
            ]);
            return $next($request);
        }

        // Check roles second
        if ($user->hasAnyRole($roles)) {
            Log::info('User has the required role(s)', [
                'roles' => $roles,
                'user_roles' => $user->roles->pluck('name')->toArray(),
            ]);
            return $next($request);
        }

        // Log missing roles/permissions
        Log::error('403 Error: User lacks the required roles/permissions', [
            'required_roles_or_permissions' => $roles,
            'user_roles' => $user->roles->pluck('name')->toArray(),
            'user_permissions' => $user->getAllPermissions()->pluck('name')->toArray(),
        ]);
    } else {
        Log::error('403 Error: Unauthorized access attempt by unauthenticated user.');
    }

    abort(403, 'Unauthorized action.');
}

}
