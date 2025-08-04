<?php

namespace Bacarin\Heimdall\Rules;

class ProhibitedWithRule
{
    public static function validate($field, $value, $param = null, $data = [])
    {
        if (!$param) {
            return "The rule 'prohibited_with' requires parameters.";
        }

        $fields = array_map('trim', explode(',', $param));

        foreach ($fields as $otherField) {
            if (isset($data[$otherField]) && ($data[$otherField] !== null && $data[$otherField] !== '')) {
                if (!is_null($value) && $value !== '') {
                    return "The field '$field' is prohibited when '$otherField' is present.";
                }
            }
        }

        return true;
    }
}
