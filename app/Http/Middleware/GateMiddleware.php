<?php

namespace App\Http\Middleware;

use App\Models\Permission;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class GateMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if($user)
        {
            $permissions = Permission::all();
            foreach ($permissions as $permission) {
                
                Gate::define($permission->slug, function (User $user) use($permission) {
                    
                    return $user->role->permissions()->where('slug',$permission->slug)->first() ? true : false;

                });

            }
        }

        return $next($request);
    }
}
