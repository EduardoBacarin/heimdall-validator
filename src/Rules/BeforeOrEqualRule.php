<?php

namespace Bacarin\Heimdall\Rules;

class BeforeOrEqualRule
{
    public static function validate($field, $value, $param = null, $data = [])
    {
        if ($value === null || $value === '') {
            return "The field '$field' must be a valid date before or equal to '$param'.";
        }

        $valueDate = self::parseDateFlexible($value);
        if ($valueDate === false) {
            return "The field '$field' must be a valid date before or equal to '$param'.";
        }

        $compareDate = self::parseSpecialDate($param);
        if ($compareDate === false) {
            $compareDate = self::parseDateFlexible($param);
            if ($compareDate === false) {
                return "The comparison date '$param' is invalid.";
            }
        }

        if ($valueDate > $compareDate) {
            return "The field '$field' must be a date before or equal to '$param'.";
        }

        return true;
    }

    private static function parseSpecialDate(?string $param)
    {
        if ($param === null) {
            return false;
        }

        $today = new \DateTime('today');
        switch (strtolower($param)) {
            case 'today':
                return $today;
            case 'yesterday':
                return (clone $today)->modify('-1 day');
            case 'tomorrow':
                return (clone $today)->modify('+1 day');
            default:
                return false;
        }
    }

    private static function parseDateFlexible($value)
    {
        if ($value instanceof \DateTime) {
            return $value;
        }

        if (!is_string($value)) {
            return false;
        }

        $formats = [
            'Y-m-d H:i:s',
            'Y-m-d',
            \DateTime::ATOM,
            'd/m/Y H:i:s',
            'd/m/Y',
        ];

        foreach ($formats as $format) {
            $dt = \DateTime::createFromFormat($format, $value);
            if ($dt && $dt->format($format) === $value) {
                return $dt;
            }
        }

        try {
            return new \DateTime($value);
        } catch (\Exception $e) {
            return false;
        }
    }
}
