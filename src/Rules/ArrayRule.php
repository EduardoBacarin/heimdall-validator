<?php

namespace Bacarin\Heimdall\Rules;

class ArrayRule
{
    public static function validate($field, $value, $param = null, $data = [])
    {
        if (!is_array($value)) {
            return "The field '$field' must be an array.";
        }

        return true;
    }
}
