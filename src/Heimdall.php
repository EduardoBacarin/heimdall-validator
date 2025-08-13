<?php

namespace Bacarin;

class Heimdall
{
    protected array $data = [];
    protected array $rules = [];
    protected array $errors = [];
    protected bool $valid = true;

    public static function validate(array $rules, array $data)
    {
        $instance = new self();
        $instance->rules = $rules;
        $instance->data = $data;
        $instance->runValidation();


        return $instance;
    }

    public function passes(): bool
    {
        return $this->valid;
    }

    public function fails(): bool
    {
        return !$this->valid;
    }

    public function errors(): array
    {
        return $this->errors;
    }
    
    protected function runValidation(): void
    {
        $this->errors = [];

        foreach ($this->rules as $field => $ruleString) {
            $ruleList = explode('|', $ruleString);

            $hasSometimes = in_array('sometimes', $ruleList, true);
            $hasNullable  = in_array('nullable', $ruleList, true);
            $isRequired   = in_array('required', $ruleList, true);
            $fieldExists  = self::fieldExistsInData($this->data, $field);

            if ($hasSometimes && !$fieldExists) {
                continue;
            }

            if (!$fieldExists && !$isRequired && !$hasSometimes) {
                continue;
            }

            $value = $fieldExists ? self::getDataValue($this->data, $field) : null;

            if ($hasNullable && $value === null) {
                continue;
            }

            foreach ($ruleList as $ruleItem) {
                if ($ruleItem === 'sometimes' || $ruleItem === 'nullable') {
                    continue;
                }

                $params = null;
                if (strpos($ruleItem, ':') !== false) {
                    [$rule, $params] = explode(':', $ruleItem, 2);
                } else {
                    $rule = $ruleItem;
                }

                $ruleName = self::ruleToClass($rule);
                $class = __NAMESPACE__ . '\\Heimdall\\Rules\\' . $ruleName . 'Rule';

                if (class_exists($class)) {
                    $result = $class::validate($field, $value, $params, $this->data);
                    if ($result !== true) {
                        $this->errors[$field][] = $result;
                    }
                } else {
                    $this->errors[$field][] = "Validation rule '$rule' is not supported.";
                }
            }
        }

        $this->valid = empty($this->errors);
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

    private static function fieldExistsInData(array $data, string $key): bool
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
