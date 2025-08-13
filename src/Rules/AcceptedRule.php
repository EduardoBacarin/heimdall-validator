<?php

namespace Bacarin\Heimdall\Rules;

class AcceptedRule
{
    public static function validate($attribute, $value, $parameters, $data)
    {
        $accepted = ['yes', 'on', '1', 1, true, 'true'];
        if (!in_array($value, $accepted, true)){
            return "The {$attribute} must be accepted.";
        }
        return true;
    }
}
