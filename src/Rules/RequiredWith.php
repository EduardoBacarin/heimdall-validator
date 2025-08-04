<?php

namespace Bacarin\Heimdall\Rules;

class RequiredWith
{
    public static function validate($field, $value, $param = null, $data = [])
    {
        if (!is_array($param)) {
            $param = explode(',', $param);
        }

        foreach ($param as $otherField) {
            if (isset($data[$otherField]) && ($data[$otherField] !== null && $data[$otherField] !== '')) {
                if (is_null($value) || (is_string($value) && trim($value) === '') || (is_array($value) && empty($value))) {
                    return "The field '$field' is required when '$otherField' is present.";
                }
                break;
            }
        }

        return true;
    }
}
