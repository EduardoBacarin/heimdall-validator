<?php

namespace Bacarin\Heimdall\Rules;

class RequiredIfInRule
{
    public static function validate($field, $value, $param = null, $data = [])
    {
        if (!$param) {
            return "The rule 'required_if_in' requires parameters.";
        }

        $parts = explode(',', $param);
        if (count($parts) < 2) {
            return "The rule 'required_if_in' requires at least two parameters: field and list of values.";
        }

        $otherField = trim(array_shift($parts));
        $values = array_map('trim', $parts);

        if (isset($data[$otherField]) && in_array((string)$data[$otherField], $values, true)) {
            if (is_null($value) || (is_string($value) && trim($value) === '') || (is_array($value) && empty($value))) {
                return "The field '$field' is required when '$otherField' is in: " . implode(', ', $values) . ".";
            }
        }

        return true;
    }
}
