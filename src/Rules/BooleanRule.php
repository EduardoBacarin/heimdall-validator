<?php

namespace Bacarin\Heimdall\Rules;

class BooleanRule
{
    public static function validate($field, $value, $param = null, $data = [])
    {
        if (!filter_var($value, FILTER_VALIDATE_BOOLEAN)) {
            return "The field '$field' must be a valid boolean value.";
        }
        
        return true;
    }
}
