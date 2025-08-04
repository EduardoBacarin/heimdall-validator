<?php

namespace Bacarin\Heimdall\Rules;

class DateRule
{
    public static function validate($field, $value, $param = null, $data = [])
    {
        if (empty($value)) {
            return true;
        }

        if (!self::isValidDate($value, $param)) {
            return "The field '$field' must be a valid date" . ($param ? " in format '$param'" : '') . ".";
        }

        return true;
    }

    protected static function isValidDate($value, $format = null)
    {
        if ($format) {
            $dt = \DateTime::createFromFormat($format, $value);
            return $dt && $dt->format($format) === $value;
        }

        return strtotime($value) !== false;
    }
}
