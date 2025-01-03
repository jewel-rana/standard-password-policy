<?php

namespace JewelRana\PasswordPolicy\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Traits\EnsureSecurityTrait;

class OldPasswordPolicyRule implements Rule
{
    use EnsureSecurityTrait;

    protected string $message;

    public function __construct()
    {
        $this->message = __('Your old password does not match');
    
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        try{
            if($this->hasAlreadyBlocked($value)) {
                $this->message = __('The :attribute has blocked due to multiple failed attempts, ['attribute' => 'email']);
                auth()->logout();
                session()->flush();
                return false;
            }
            
            if(!Hash::check($value, auth()->user()->password)) {
                $this->failedAttempt(request(), auth()->user()->email);
                return false;
            }
        } catch(\Exception $exception) {
            Log::error($exception->getMessage());
            $this->message = __('Internal server error');
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return $this->message;
    }
}
