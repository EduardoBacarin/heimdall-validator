<?php

namespace Bacarin\Heimdall\Rules;

class Required
{
    public static function validate($field, $value, $param = null, $data = [])
    {
        if (is_null($value) || (is_string($value) && trim($value) === '') || (is_array($value) && empty($value))) {
            return "The field '$field' is required.";
        }

        return true;
    }
}
