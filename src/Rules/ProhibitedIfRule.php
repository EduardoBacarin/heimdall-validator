<?php

namespace Bacarin\Heimdall\Rules;

class ProhibitedIfRule
{
    public static function validate($attribute, $value, $parameters, $data)
    {
        if (!is_array($parameters)) {
            $parameters = explode(',', $parameters);
        }

        if (count($parameters) < 2) {
            return true;
        }

        $otherField = $parameters[0];
        $expectedValue = $parameters[1];

        if ((isset($data[$otherField]) && $data[$otherField] == $expectedValue) && isset($data[$attribute])) {
            return "The field {$attribute} is prohibited when {$parameters[0]} is {$parameters[1]}.";
        }

        return true;
    }
}
