<?php

class Cookie
{
    //This metod checks if the cookie exists.
    public static function exists($name)
    {
        return (isset($_COOKIE[$name])) ? true : false;;
    }

    //This method will return the Cookie if it exists
    public static function get($name)
    {
        return $_COOKIE[$name];
    }

    //This method sets the Cookie 
    public static function set($name, $value, $expire)
    {
        if (setcookie($name, $value, time() + $expire, '/')) {
            return true;
        }

        return false;
    }

    //This method will delete the Cookie
    public static function delete($name)
    {
        self::set($name, '' , time() - 1, '/');
    }
}
