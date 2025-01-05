<?php

namespace JewelRana\PasswordPolicy\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Traits\EnsureSecurityTrait;
use Illuminate\Support\Facades\Log;

class OldPasswordPolicyRule implements Rule
{
    use EnsureSecurityTrait;

    protected string $message;
    protected string $attemptType;

    public function __construct($attemptType = 'RESET_PASSWORD_ATTEMPT')
    {
        $this->message = __('Your old password does not match');
        $this->attemptType = $attemptType;
    }
    
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     */
    public function passes($attribute, $value)
    {
        try{
            $identity = auth()->user()->email ?? request()->input('email') ?? $value;
            if($this->hasAlreadyBlocked($identity) {
               $this->message = __('Your account has already been blocked');
                return true;
            }
            if(!Hash::check($value, auth()->user()->password)) {
                $this->failedAttempt(request(), $identity, $this->attemptType);
                return false;
            }
            return true;
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
