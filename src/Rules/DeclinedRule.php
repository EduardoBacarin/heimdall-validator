<?php

namespace Bacarin\Heimdall\Rules;

class DeclinedRule
{
    public static function validate($attribute, $value, $parameters, $data)
    {
        $declined = ['no', 'off', 0, '0', false, 'false'];

        if (in_array($value, $declined, true)) {
            return true;
        }

        return "The {$attribute} must be declined.";
    }
}
