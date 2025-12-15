<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\SystemAuthorization;

class CheckPermission
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $admin = Auth::guard('admin')->user();

        if (!$admin) {
            return redirect()->route('admin.login');
        }

        $currentPath = Route::getFacadeRoot()->current()->uri(); // current route URL
        $privilege = SystemAuthorization::where('route_url', $currentPath)->first();

        if ($privilege) {
            $allowedRoles = json_decode($privilege->role_id, true);
            if (in_array($admin->role_id, $allowedRoles)) {
                return $next($request); // authorized
            }
        }

        // Unauthorized
        abort(403, 'Unauthorized action.');
    }
}
