<?php

namespace JewelRana\PasswordPolicy\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use JewelRana\PasswordPolicy\Rules\StrongPasswordRule;
use JewelRana\PasswordPolicy\Rules\OldPasswordPolicyRule;
use JewelRana\PasswordPolicy\Rules\PreviousPasswordPolicyRule;

class ResetPasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'old_password' => ['required', new OldPasswordPolicyRule()],
            'password' => ['bail', 'required', 'confirmed', 'different:old_password',
                new StrongPasswordRule(),
                new PreviousPasswordPolicyRule(auth()->user()->id ?? null)
                ]
        ];
    }
}

