<?php

namespace Bacarin\Heimdall\Rules;

class InRule
{
    public static function validate($field, $value, $param = null, $data = [])
    {
        if (!is_array($param)) {
            $param = explode(',', $param);
        }

        if (!in_array((string) $value, array_map('strval', $param), true)) {
            return "The field '$field' must be one of the following values: " . implode(', ', $param) . ".";
        }

        return true;
    }
}
