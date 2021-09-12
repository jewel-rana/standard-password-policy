<?php

namespace JewelRana\PasswordPolicy\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use JewelRana\PasswordPolicy\Models\UserPassword;

class PreviousPasswordPolicyRule implements Rule
{

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $previousPasswords = UserPassword::where('user_id', auth()->user()->id)->latest()->get();
        return  $previousPasswords->filter(function($item, $key) use($value) {
            return Hash::check($value, $item->password, []);
        })->count() === 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return __('You are not allowed to use previous passwords as new password');
    }
}
