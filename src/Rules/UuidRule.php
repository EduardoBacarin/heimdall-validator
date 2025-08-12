<?php

namespace Bacarin\Heimdall\Rules;

class UuidRule
{
    public static function validate($attribute, $value, $parameters, $data)
    {
        if (!is_string($value)) {
            return "The {$attribute} must be a string.";
        }

        $value = trim($value);

        $pattern = '/^[0-9a-f]{8}-[0-9a-f]{4}-([1-5])[0-9a-f]{3}-([89ab])[0-9a-f]{3}-[0-9a-f]{12}$/i';

        if (!preg_match($pattern, $value, $matches)) {
            return "The {$attribute} must be a valid UUID.";
        }

        $version = $matches[1];
        $variant = strtolower($matches[2]);

        $expectedVersion = trim($parameters ?? '');

        if ($expectedVersion !== '') {
            if (!in_array($expectedVersion, ['1','2','3','4','5'])) {
                return "The rule uuid supports only versions 1 to 5.";
            }
            if ($version !== $expectedVersion) {
                return "The {$attribute} must be a UUID version {$expectedVersion}.";
            }
        }

        $validVariants = ['8', '9', 'a', 'b'];
        if (!in_array($variant, $validVariants)) {
            return "The {$attribute} contains an invalid UUID variant.";
        }

        return true;
    }
}
