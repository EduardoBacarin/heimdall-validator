<?php

namespace Bacarin\Heimdall\Rules;

class Max
{
    public static function validate($field, $value, $param = null, $data = [])
    {
        if (is_null($param)) {
            return "The rule 'max' for field '$field' requires a parameter.";
        }

        if (is_string($value)) {
            if (mb_strlen($value) > (int)$param) {
                return "The field '$field' must not exceed $param characters.";
            }
        } elseif (is_array($value)) {
            if (count($value) > (int)$param) {
                return "The field '$field' must not have more than $param items.";
            }
        } elseif (is_numeric($value)) {
            if ($value > (int)$param) {
                return "The field '$field' must not be greater than $param.";
            }
        }

        return true;
    }
}
