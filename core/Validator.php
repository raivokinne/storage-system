<?php

namespace Core\Validation;

use Core\Container\App;
use Core\Database\Database;

class Validator
{
    private static $connection = null;
    private static $data = [];
    public static function set_data($data): void
    {
        static::$data = $data;
    }
    public static function min($value, $min): bool|string
    {
        if (strlen($value) >= $min) {
            return false;
        }
        return " must be at least {$min} characters long.";
    }
    public static function max($value, $max): bool|string
    {
        if (strlen($value) <= $max) {
            return false;
        }
        return " must not exceed {$max} characters.";
    }
    public static function email($value): bool|string
    {
        if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return " must be a valid email address.";
    }
    public static function required($value): bool|string
    {
        if (!empty($value)) {
            return false;
        }
        return " is required.";
    }
    public static function unique($value, $table_data): bool|string
    {
        if (empty($value)) {
            return false;
        }
            static::$connection ?? static::$connection = App::resolve(Database::class);
        try {
            $result = static::$connection->query("SELECT * FROM {$table_data[0]} WHERE {$table_data[1]} = :value", compact('value'))->fetch();
        } catch (\Exception $e) {
            return false;
        }
        if (!$result) {
            return false;
        }
        return " already exists.";
    }
    public static function date($value): bool|string
    {
        $date = date_parse($value);
        if ($date['error_count'] === 0 && checkdate($date['month'], $date['day'], $date['year'])) {
            return false;
        }
        return " must be a valid date.";
    }
    public static function numeric($value): bool|string
    {
        if (is_numeric($value)) {
            return false;
        }
        return " must be a number.";
    }
    public static function boolean($value): bool|string
    {
        if (is_bool($value)) {
            return false;
        }
        return " must be a boolean.";
    }
    public static function string($value): bool|string
    {
        if (is_string($value)) {
            return false;
        }
        return " must be a string.";
    }
    public static function integer($value): bool|string
    {
        if (is_int($value)) {
            return false;
        }
        return " must be an integer.";
    }
    public static function float($value): bool|string
    {
        if (is_float($value)) {
            return false;
        }
        return " must be a float.";
    }
    public static function array($value): bool|string
    {
        if (is_array($value)) {
            return false;
        }
        return " must be an array.";
    }
    public static function nullable($value): bool|string
    {
        if ($value === null) {
            return false;
        }
        return " must be nullable.";
    }

    public static function confirmed($value): bool|string
    {
        if ($value === static::$data['confirm_password']) {
            return false;
        }
        return " must be confirmed.";
    }

    public static function alpha($value): bool|string
    {
        if (ctype_alpha($value)) {
            return false;
        }
        return " must be alphabetic.";
    }

    public static function alpha_num($value): bool|string
    {
        if (ctype_alnum($value)) {
            return false;
        }
        return " must be alphanumeric.";
    }

    public static function alpha_dash($value): bool|string
    {
        if (preg_match('/^[a-zA-Z0-9_-]*$/', $value)) {
            return false;
        }
        return " must be alphabetic, numeric, dash, or underscore.";
    }
    public static function not_today($value): bool|string
    {
        if ($value > date('Y-m-d')) {
            return false;
        }
        return " must not be today.";
    }

}