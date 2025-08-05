<?php

namespace Bacarin\Heimdall\Rules;

class LtRule
{
    public static function validate($field, $value, $param, $data = [])
    {
        $compare = array_key_exists($param, $data) ? $data[$param] : $param;

        if (!is_numeric($value) || !is_numeric($compare)) {
            return "The fields '$field' and '$param' must be numeric for 'lt' validation.";
        }

        if ($value >= $compare) {
            return "The field '$field' must be less than '$param'.";
        }

        return true;
    }
}
