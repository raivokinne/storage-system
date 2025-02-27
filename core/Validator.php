<?php

namespace Core;

use Database\Database;

class Validator
{
    /**
     * Validate if the given value is a string and that it is in a certain threshold.
     *
     * @param $value
     * @param int $min
     * @param float $max
     * @return bool
     */
    public static function string($value, int $min = 0, float $max = INF) : bool
    {
        $value = trim($value);

        return strlen($value) >= $min && strlen($value) <= $max;
    }

    /**
     * Validate if the given value is an email and that it is in a certain threshold.
     *
     * @param $value
     * @param int $min
     * @param float $max
     * @return bool
     */
    public static function email($value, int $min = 0, float $max = INF) : bool
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL) && strlen($value) >= $min && strlen($value) <= $max;
    }

    /**
     * Validate if the given value is a number and that it is in a certain threshold.
     *
     * @param $value
     * @param int $min
     * @param float $max
     * @return bool
     */
    public static function number($value, int $min = 0, float $max = INF) : bool
    {
        return is_numeric($value) && $value >= $min && $value <= $max;
    }

    /**
     * Validate if the given string contains at least one uppercase letter, one lowercase letter, one number and one special character
     *
     * @param $value
     * @return bool
     */

    public static function password($value) : bool
    {
        return preg_match('/[A-Z]/', $value) && preg_match('/[a-z]/', $value) && preg_match('/[0-9]/', $value) && preg_match('/[^A-Za-z0-9]/', $value);
    }
}