<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PhoneNumber implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $regex = '/^(0|\+84|84)[1-9][0-9]{8}$/';
        if (!preg_match($regex, $value)) {
            $fail('Số điện thoại không hợp lệ.');
        }

    }
}
