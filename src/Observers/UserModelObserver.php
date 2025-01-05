<?php
namespace JewelRana\PasswordPolicy\Observers;

use App\Models\User;
use JewelRana\PasswordPolicy\Models\UserPassword;

class UserModelObserver {

    public function created(User $user)
    {
        UserPassword::create(['user_id' => $user->id, 'password' => $user->password]);
    }

    public function updated(User $user)
    {
        if(request()->filled('password') !in_array(request()->uri(), ['auth/login-step-2', 'auth/login'])) {
            UserPassword::create(['user_id' => $user->id, 'password' => $user->password]);
        }
    }
}
