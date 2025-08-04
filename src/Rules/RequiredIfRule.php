<?php

namespace Bacarin\Heimdall\Rules;

class RequiredIfRule
{
    public static function validate($field, $value, $param = null, $data = [])
    {
        if (!$param) {
            return "The rule 'required_if' requires parameters.";
        }

        $parts = explode(',', $param);
        if (count($parts) < 2) {
            return "The rule 'required_if' requires two parameters: field and value.";
        }

        $otherField = trim($parts[0]);
        $expectedValue = trim($parts[1]);

        if (isset($data[$otherField]) && (string)$data[$otherField] === $expectedValue) {
            if (is_null($value) || (is_string($value) && trim($value) === '') || (is_array($value) && empty($value))) {
                return "The field '$field' is required when '$otherField' is '$expectedValue'.";
            }
        }

        return true;
    }
}
