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

    public function __construct()
    {
        $this->message = __('Your old password does not match');
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
            if($this->hasAlreadyBlocked($identity)) {
                auth()->logout();
                return redirect()->route('auth.login')->with([
                    'message' => [
                        'label' => 'info',
                        'content' => __('Your account has blocked due to multiple failed attempts.')
                    ]
                ]);
            }
            
            if(!Hash::check($value, auth()->user()->password)) {
                $this->failedAttempt(request(), auth()->user()->email);
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
