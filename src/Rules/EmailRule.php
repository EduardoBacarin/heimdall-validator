<?php

namespace Bacarin\Heimdall\Rules;

class EmailRule
{
    public static function validate($field, $value, $param = null, $data = [])
    {
        if (!is_string($value) || !filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return "The field '$field' must be a valid email address.";
        }

        return true;
    }
}
