<?php
namespace JewelRana\PasswordPolicy\Rules;

use Illuminate\Support\Str;
use Illuminate\Contracts\Validation\Rule;

class StrongPasswordRule implements Rule
{
    /**
     * Determine if the Length Validation Rule passes.
     *
     * @var boolean
     */
    public $lengthPasses = true;

    /**
     * Determine if the Uppercase Validation Rule passes.
     *
     * @var boolean
     */
    public $uppercasePasses = true;

    /**
     * Determine if the Lowercase Validation Rule passes.
     *
     * @var boolean
     */
    public $lowercasePasses = true;

    /**
     * Determine if the Numeric Validation Rule passes.
     *
     * @var boolean
     */
    public $numericPasses = true;

    /**
     * Determine if the Special Character Validation Rule passes.
     *
     * @var boolean
     */
    public $specialCharacterPasses = true;

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $this->uppercasePasses = (Str::lower($value) !== $value);
        $this->lowercasePasses = (Str::upper($value) !== $value);
        $this->numericPasses = ((bool) preg_match('/[0-9]/', $value));
        $this->specialCharacterPasses = ((bool) preg_match('/[^A-Za-z0-9]/', $value));

        return ($this->uppercasePasses && $this->lowercasePasses && $this->numericPasses && $this->specialCharacterPasses);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        switch (true) {
            case ! $this->uppercasePasses:
                return 'The :attribute must contain at least one uppercase character.';

            case ! $this->lowercasePasses:
                return 'The :attribute must contain at least one lowercase character.';

            case ! $this->numericPasses:
                return 'The :attribute must contain at least one number.';

            case ! $this->specialCharacterPasses:
                return 'The :attribute must contain at least one special character.';

            default:
                return 'The :attribute is not strong enough.';
        }
    }
}
