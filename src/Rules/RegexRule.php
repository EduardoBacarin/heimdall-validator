<?php

namespace Bacarin\Heimdall\Rules;

class RegexRule
{
    public static function validate($attribute, $value, $parameters, $data)
    {
        if (empty($parameters)) {
            return "The rule regex requires a regular expression pattern.";
        }

        $pattern = $parameters;

        $delimiters = ['/', '#', '~'];
        $firstChar = $pattern[0];
        $lastChar = substr($pattern, -1);

        if (in_array($firstChar, $delimiters)) {
            $lastDelimiterPos = strrpos($pattern, $firstChar);
            $regexBody = substr($pattern, 1, $lastDelimiterPos - 1);
            $flags = substr($pattern, $lastDelimiterPos + 1);

            $pattern = '/' . $regexBody . '/' . $flags;
        } else {
            $pattern = '/' . $pattern . '/';
        }

        if (!is_string($value)) {
            return "The {$attribute} must be a string.";
        }

        $result = @preg_match($pattern, $value);

        if ($result === false) {
            return "The regex pattern provided for {$attribute} is invalid.";
        }

        if ($result === 0) {
            return "The {$attribute} format is invalid.";
        }

        return true;
    }
}
