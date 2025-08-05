<?php

namespace Bacarin\Heimdall\Rules;

class GtRule
{
    public static function validate($field, $value, $param, $data = [])
    {
        $compare = array_key_exists($param, $data) ? $data[$param] : $param;

        if (!is_numeric($value) || !is_numeric($compare)) {
            return "The fields '$field' and '$param' must be numeric for 'gt' validation.";
        }

        if ($value <= $compare) {
            return "The field '$field' must be greater than '$param'.";
        }

        return true;
    }
}
