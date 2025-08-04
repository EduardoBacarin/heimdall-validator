<?php

namespace Bacarin;

class Heimdall
{
    public static function validate(array $rules, array $data): array
    {
        $errors = [];

        foreach ($rules as $field => $ruleString) {
            $value = self::getDataValue($data, $field);
            $ruleList = explode('|', $ruleString);

            foreach ($ruleList as $rule) {
                $params = null;

                if (strpos($rule, ':') !== false) {
                    [$rule, $params] = explode(':', $rule, 2);
                }

                $ruleName = self::ruleToClass($rule);
                $class = __NAMESPACE__ . '\\Heimdall\\Rules\\' . $ruleName . 'Rule';
                if (class_exists($class)) {
                    $result = $class::validate($field, $value, $params, $data);
                    if ($result !== true) {
                        $errors[$field][] = $result;
                    }
                } else {
                    $errors[$field][] = "Validation rule '$rule' is not supported.";
                }
            }
        }

        return ['valid' => empty($errors), 'errors' => $errors];
    }

    private static function ruleToClass(string $rule): string
    {
        $rule = str_replace('_', ' ', $rule);
        $rule = ucwords($rule);
        $rule = str_replace(' ', '', $rule);
        return $rule;
    }

    private static function getDataValue(array $data, string $key)
    {
        $keys = explode('.', $key);
        foreach ($keys as $k) {
            if (is_array($data) && array_key_exists($k, $data)) {
                $data = $data[$k];
            } else {
                return null;
            }
        }
        return $data;
    }
}
