<?php

namespace JewelRana\PasswordPolicy\Services;

use App\Models\User;

class ResetPasswordService
{
    public function resetPassword(array $data)
    {
        $user = User::first();
        $user->update(['password' => bcrypt($data['password'])]);
        auth()->login($user);
    }
}
