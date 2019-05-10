<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NationalCode implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $this->isValid($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('messages.national_code');
    }

    //my nationalcode validation
    private $invalidCodes = [
        1111111111,
        2222222222,
        3333333333,
        4444444444,
        5555555555,
        6666666666,
        7777777777,
        8888888888,
        9999999999,
        0000000000
    ];

    private function isTenDigits($value)
    {
        if (strlen($value) == 10) return true;
        return false;
    }

    private function invalidCode($nationalCode) 
    {
        foreach ($this->invalidCodes as $invalidCode ) {
            if ($invalidCode == $nationalCode) return true;
        }
    }

    private function sumOfDigits($value) 
    {
        $sum = 0;
        $array = str_split($value);
        $counter = 10;
        for ($i=0; $i<9; $i++) {
            $sum += $array[$i] * $counter;
            $counter--;
        }

        return $sum;
    }

    private function isValid($nationalCode) 
    {
        if (!$this->isTenDigits($nationalCode)) {
            return false;
        }

        if (!$this->invalidCode($nationalCode)) {
            $sum = $this->sumOfDigits($nationalCode);
            $controlNum = substr($nationalCode, 9);
            $recurrent = $sum % 11;
            $isValidControlNum = $recurrent < 2 && $controlNum == $recurrent;
            $isContorlNumEqualToEleven = $controlNum + $recurrent == 11;
            if ($isValidControlNum || $isContorlNumEqualToEleven) return true;
        } 
    }
}
