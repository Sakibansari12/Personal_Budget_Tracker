<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class checkLoginType
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
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->user_type == 'Superadmin') {
                return redirect(route('admin.dashboard'));
            } else if ($user->user_type == 'Commissioner') {
                return redirect(route('admin.dashboard'));
            } else if ($user->user_type == 'Project Officer') {
                return redirect(route('admin.dashboard'));
            }else if ($user->user_type == 'Headmaster') {
                return redirect(route('admin.dashboard'));
            }else if ($user->user_type == 'School Member') {
                return redirect(route('admin.dashboard'));
            } 
        } 
        return $next($request);
        
    }
}
