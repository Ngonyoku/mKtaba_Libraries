<?php

class Session
{
    //Check if Session Exists
    public static function exists($name)
    {
        return (isset($_SESSION[$name])) ? true : false;
    }

    //This method Sets our Session
    public static function set($name, $value)
    {
        return $_SESSION[$name] = $value;
    }

    //This method returns the value of the session with the name passed.
    public static function get($name)
    {
        return $_SESSION[$name];
    }

    //This method unsets a session.
    public static function delete($name)
    {
        if (self::exists($name)) {
            unset($_SESSION[$name]);
        }
    }

    public static function flash($name, $string = "")
    {
        if (self::exists($name)) {
            $session = self::get($name);
            return $session;
        } else {
            self::set($name, $string);
        }
    }
}
