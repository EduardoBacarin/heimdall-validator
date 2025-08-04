<?php

namespace Bacarin\Heimdall\Rules;

class StringRule
{
    public static function validate($field, $value, $param = null, $data = [])
    {
        if (!is_string($value)) {
            return "The field '$field' must be a string.";
        }

        return true;
    }
}
