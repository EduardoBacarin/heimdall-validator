<?php

namespace Bacarin\Heimdall\Rules;

class NullableRule
{
    public static function validate($field, $value, $param = null, $data = [])
    {
        if ($value === null || $value === '') {
            return true;
        }
        return true;
    }
}
