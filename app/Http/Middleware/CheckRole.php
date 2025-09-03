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
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect('login');
        }
        
        $user = Auth::user();
        
        // Kiểm tra role truyền vào
        switch ($role) {
            case 'admin':
                if (!$user->isAdmin()) {
                    abort(403, 'Unauthorized action.');
                }
                break;
            case 'staff':
                if (!$user->isStaff()) {
                    abort(403, 'Unauthorized action.');
                }
                break;
            case 'customer':
                if (!$user->isCustomer()) {
                    abort(403, 'Unauthorized action.');
                }
                break;
            default:
                abort(403, 'Undefined role.');
        }
        
        return $next($request);
    }
}
