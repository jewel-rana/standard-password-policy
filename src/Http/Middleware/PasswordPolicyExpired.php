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
        if(!in_array(request()->route()->uri(), ['dashboard/logout', 'auth/logout', 'logout']) && !$request->routeIs('password-policy.*') && auth()->check()) {
            $user = $request->user();
            $lastChanged = UserPassword::where('user_id', $user->id)->latest()->first();
            $password_changed_at = new Carbon($lastChanged->created_at ?? $user->created_at);
            $dateDiff = Carbon::now()->diffInDays($password_changed_at);
            $expireDays = (config('password-policy.max_expire_days', 30));
            $alertDays = (config('password-policy.expire_alert_days', 25));
            $remainingDays = $expireDays - $dateDiff;
            if ($dateDiff >= $alertDays && $dateDiff <= $expireDays) {
                session()->flash('alertMessage', "Your password are about to expire within {$remainingDays} days. Please <a href='" . route('change-password'). "'><strong>change</strong></a> your password.");
            }

            if($dateDiff >= $expireDays) {
                session()->flash('message', 'Your password has expire please reset your password.');
                return redirect()->route('password-policy.reset')
                    ->with(['message' => ['label' => 'info', 'content' => 'Your password has expired please reset your password.']]);
            }
        }
        return $next($request);
    }
}

