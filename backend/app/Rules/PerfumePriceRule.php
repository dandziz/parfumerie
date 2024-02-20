<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PerfumePriceRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $arr = json_decode($value);
        if (!is_array($arr) || count($arr) == 0) {
            $fail('Thông tin về giá của nước hoa chưa đầy đủ.');
        } else {
            foreach($arr as $item) {
                $importPrice = 0;
                $price = 0;
                if (ctype_digit($item[1])) {
                    $importPrice = intval($item[1]);
                }
                if (ctype_digit($item[2])) {
                    $price = intval($item[2]);
                }
                if (!is_string($item[0]) || $importPrice == 0 || $price == 0) {
                    $fail('Thông tin về giá của nước hoa không đúng định dạng.');
                }
            }
        }
    }
}
