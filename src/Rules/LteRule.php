<?php

namespace Bacarin\Heimdall\Rules;

class LteRule
{
    public static function validate($field, $value, $param, $data = [])
    {
        $compare = array_key_exists($param, $data) ? $data[$param] : $param;

        if (!is_numeric($value) || !is_numeric($compare)) {
            return "The fields '$field' and '$param' must be numeric for 'lte' validation.";
        }

        if ($value > $compare) {
            return "The field '$field' must be less than or equal to '$param'.";
        }

        return true;
    }
}
