<?php

namespace JewelRana\PasswordPolicy\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Traits\EnsureSecurityTrait;

class ResetPasswordService
{
    use EnsureSecurityTrait;
    
    public function resetPassword(array $data)
    {
        $user = User::first();
        if($this->hasAlreadyBlocked($user->email)) {
                auth()->logout();
                return redirect()->route('auth.login')->with([
                    'message' => [
                        'label' => 'info',
                        'content' => __('Your account has blocked due to multiple failed attempts.')
                    ]
                ]);
        }
        $user->update(['password' => bcrypt($data['password'])]);
        auth()->login($user);
        Auth::logoutOtherDevices($data['password']);
    }
}
