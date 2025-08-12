<?php

namespace Bacarin\Heimdall\Rules;

class AcceptedIfRule
{
    public static function validate($attribute, $value, $parameters, $data)
    {
        $params = explode(',', $parameters);
        if (count($params) < 2) {
            return "The rule accepted_if requires two parameters.";
        }

        [$otherField, $expectedValue] = $params;
        $otherValue = self::getDataValue($data, $otherField);

        if ($otherValue !== $expectedValue) {
            return true;
        }

        $accepted = ['yes', 'on', '1', 1, true, 'true'];

        if (!in_array($value, $accepted, true)) {
            return "The {$attribute} must be accepted when {$otherField} is {$expectedValue}.";
        }

        return true;
    }

    private static function getDataValue($data, $key)
    {
        $keys = explode('.', $key);
        foreach ($keys as $k) {
            if (is_array($data) && array_key_exists($k, $data)) {
                $data = $data[$k];
            } else {
                return null;
            }
        }
        return $data;
    }
}
