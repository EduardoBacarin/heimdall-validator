<?php

namespace Bacarin\Heimdall\Rules;

class AcceptedRule
{
    public static function validate($attribute, $value, $parameters, $data)
    {
        $accepted = ['yes', 'on', '1', 1, true, 'true'];

        return in_array($value, $accepted, true);
    }

    public static function message($attribute, $parameters)
    {
        return "The {$attribute} must be accepted.";
    }
}
