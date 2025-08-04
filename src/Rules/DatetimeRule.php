<?php

namespace Bacarin\Heimdall\Rules;

class DatetimeRule
{
    public static function validate($field, $value, $param = null, $data = [])
    {
        if ($value === null || $value === '') {
            return "The field '$field' must be a valid datetime.";
        }

        if ($value instanceof \DateTime) {
            return true;
        }

        if (!is_string($value)) {
            return "The field '$field' must be a valid datetime string.";
        }

        // Se passar um formato customizado para validar
        if ($param !== null) {
            $d = \DateTime::createFromFormat($param, $value);
            if (!$d || $d->format($param) !== $value) {
                return "The field '$field' must match the format '$param'.";
            }
            return true;
        }

        // Tenta validar formato ISO 8601 ou qualquer formato datetime reconhecido
        $d = \DateTime::createFromFormat('Y-m-d H:i:s', $value);
        if ($d && $d->format('Y-m-d H:i:s') === $value) {
            return true;
        }

        // Tenta ISO 8601 completo (ex: 2024-08-04T15:23:01+00:00)
        $d = \DateTime::createFromFormat(\DateTime::ATOM, $value);
        if ($d !== false) {
            return true;
        }

        return "The field '$field' must be a valid datetime.";
    }
}
