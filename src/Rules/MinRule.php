<?php

namespace Bacarin\Heimdall\Rules;

class MinRule
{
    public static function validate($field, $value, $param = null, $data = [])
    {
        if (is_null($param)) {
            return "The rule 'min' for field '$field' requires a parameter.";
        }

        if (is_string($value)) {
            if (mb_strlen($value) < (int)$param) {
                return "The field '$field' must be at least $param characters.";
            }
        } elseif (is_array($value)) {
            if (count($value) < (int)$param) {
                return "The field '$field' must have at least $param items.";
            }
        } elseif (is_numeric($value)) {
            if ($value < (int)$param) {
                return "The field '$field' must be at least $param.";
            }
        }

        return true;
    }
}
