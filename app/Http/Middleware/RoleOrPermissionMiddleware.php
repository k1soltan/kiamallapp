<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleOrPermissionMiddleware
{
    public function handle($request, Closure $next, $rolesOrPermissions)
    {
        $user = Auth::user();

        if ($user) {
            $rolesOrPermissions = explode('|', $rolesOrPermissions);

            if ($user->hasAnyRole($rolesOrPermissions) || $user->hasAnyPermission($rolesOrPermissions)) {
                return $next($request);
            }
        }

        abort(403, 'Unauthorized action.');
    }
}
