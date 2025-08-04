<?php

namespace Bacarin\Heimdall\Rules;

class Integer
{
    public static function validate($field, $value, $param = null, $data = [])
    {
        if (filter_var($value, FILTER_VALIDATE_INT) === false) {
            return "The field '$field' must be an integer.";
        }

        return true;
    }
}
