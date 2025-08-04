<?php

namespace Bacarin;

class Heimdall
{
    public static function validate(array $rules, array $data): array
    {
        $errors = [];

        foreach ($rules as $field => $ruleString) {
            $ruleList = explode('|', $ruleString);
            $hasRequired = self::hasRequiredRule($ruleList);
            $hasSometimes = in_array('sometimes', $ruleList);
            $hasNullable = in_array('nullable', $ruleList);
            $fieldExists = self::dataKeyExists($data, $field);
            $value = self::getDataValue($data, $field);

            if (!$fieldExists && $hasSometimes && !$hasRequired) {
                continue;
            }

            foreach ($ruleList as $rule) {
                $params = null;

                if (strpos($rule, ':') !== false) {
                    [$rule, $params] = explode(':', $rule, 2);
                }

                if ($rule === 'sometimes' || $rule === 'nullable') {
                    continue;
                }

                if ($hasNullable && ($value === null || $value === '')) {
                    break;
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

    private static function hasRequiredRule(array $rules): bool
    {
        foreach ($rules as $rule) {
            if (str_starts_with($rule, 'required')) {
                return true;
            }
        }
        return false;
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

    private static function dataKeyExists(array $data, string $key): bool
    {
        $keys = explode('.', $key);
        foreach ($keys as $k) {
            if (is_array($data) && array_key_exists($k, $data)) {
                $data = $data[$k];
            } else {
                return false;
            }
        }
        return true;
    }
}
