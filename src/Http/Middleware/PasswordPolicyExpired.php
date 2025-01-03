<?php

namespace JewelRana\PasswordPolicy\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use JewelRana\PasswordPolicy\Models\UserPassword;

class PasswordPolicyExpired
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!in_array(request()->route()->uri(), ['dashboard/logout', 'logout']) && !$request->routeIs('password-policy.*') && auth()->check()) {
            $user = $request->user();
            $lastChanged = UserPassword::where('user_id', $user->id)->latest()->first();
            $password_changed_at = new Carbon($lastChanged->created_at ?? $user->created_at);
    
            if (Carbon::now()->diffInDays($password_changed_at) >= (config('password-policy.max_expire_days') ?? 30)) {
                session()->flash('message', 'Your password has expired. please reset it');
                return redirect()->route('password-policy.form');
            }
        }
        return $next($request);
    }
}
