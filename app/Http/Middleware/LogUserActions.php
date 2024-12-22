<?php 

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Mobile_Detect;
use Detection\MobileDetect;

class LogUserActions
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $user = Auth::user();
        $detect = new Mobile_Detect();
        $device = $detect->isMobile() ? 'Mobile' : ($detect->isTablet() ? 'Tablet' : 'Desktop');
        $browser = $detect->getBrowser();
        $ip = $request->ip();

        Log::info('User Action Logged', [
            'user' => $user ? [
                'id' => $user->id,
                'name' => $user->name,
            ] : 'Guest',
            'device' => $device,
            'browser' => $browser,
            'ip_address' => $ip,
            'timestamp' => now()->toDateTimeString(),
        ]);


        return $response;
    }

    /**
     * Determine the type of action based on the route action method.
     *
     * @param string $routeAction
     * @return string
     */
    protected function determineActionType($routeAction)
    {
        $actionMap = [
            'index' => 'view',
            'show' => 'view details',
            'create' => 'create',
            'store' => 'store',
            'edit' => 'edit',
            'update' => 'update',
            'destroy' => 'delete',
        ];

        return $actionMap[$routeAction] ?? 'unknown';
    }
}
