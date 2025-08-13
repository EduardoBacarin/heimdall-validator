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
            return true; // ou false, dependendo da lógica
        }

        $otherField = $parameters[0];
        $expectedValue = $parameters[1];

        if ((isset($data[$otherField]) && $data[$otherField] == $expectedValue) && isset($data[$attribute])) {
            return false;
        }

        return true;
    }


    public static function message($field, $parameters)
    {
        return "The field {$field} is prohibited when {$parameters[0]} is {$parameters[1]}.";
    }
}
