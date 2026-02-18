<?php

namespace Core;

class Validator
{
    public static function string($value, $min = 1, $max = INF): bool
    {
        $value = trim($value);
        return strlen($value) >= $min && strlen(trim($value)) <= $max;
    }

    public static function email($value): mixed
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }
}
