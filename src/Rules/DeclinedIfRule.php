<?php

namespace Bacarin\Heimdall\Rules;

class DeclinedIfRule
{
    public static function validate($attribute, $value, $parameters, $data)
    {
        $params = explode(',', $parameters);

        if (count($params) < 2) {
            return "The rule declined_if requires two parameters.";
        }

        [$otherField, $expectedValue] = $params;

        $otherValue = self::getDataValue($data, $otherField);

        if ($otherValue !== $expectedValue) {
            return true;
        }

        $declined = ['no', 'off', 0, '0', false, 'false'];

        if (!in_array($value, $declined, true)) {
            return "The {$attribute} must be declined when {$otherField} is {$expectedValue}.";
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
