<?php

namespace Bacarin\Heimdall\Rules;

class ProhibitedIfInRule
{
    public static function validate($attribute, $value, $parameters, $data)
    {
        if (!is_array($parameters)) {
            $parameters = explode(',', $parameters);
        }

        if (count($parameters) < 2) {
            return true;
        }

        $otherField = array_shift($parameters);
        $expectedValues = $parameters;

        if (isset($data[$otherField]) && in_array($data[$otherField], $expectedValues) && isset($data[$attribute])){
            $values = implode(', ', $parameters);
            return "The field {$attribute} is prohibited when {$otherField} is in [{$values}].";
        }

        return true;
    }
}
