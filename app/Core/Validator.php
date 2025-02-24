<?php
class Validator
{

    public static function Email(string $email)
    {
        $string = trim($email);

        if(!filter_var($string, FILTER_VALIDATE_EMAIL))
        {
            return false;
        }

        return true;
    }

    public static function Password(string $password, $min = 0, $max = INF)
    {
        $string = trim($password);

        if(!is_string($string))
        {
            return false;
        }

        if(strlen($string) < $min)
        {
            return false;
        }

        if(strlen($string) >= $max)
        {
            return false;
        }

        return true;
    }

    public static function String(string $string, $min = 0, $max = INF)
    {
        $string = trim($string);

        if(!is_string($string))
        {
            return false;
        }

        if(strlen($string) < $min)
        {
            return false;
        }

        if(strlen($string) >= $max)
        {
            return false;
        }

        return true;
    }

    public static function Number($number, $min = 0, $max = INF)
    {

        if(!is_numeric($number))
        {
            return false;
        }

        if($number <= $min)
        {
            return false;
        }

        if($number >= $max)
        {
            return false;
        }

        return true;
    }

}