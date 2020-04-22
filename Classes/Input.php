<?php

class Input
{
    public static function exists($type = 'post')
    {
        switch ($type) {
            case 'post':
                return (empty($_POST)) ? false : true;
                break;
            case 'get':
                return (empty($_GET)) ? false : true;
                break;
            default:
                return false;
                break;
        }
    }

    public static function get($name)
    {
        if (isset($_POST[$name])) {
            return $_POST[$name];
        } elseif (isset($_GET[$name])) {
            return $_GET[$name];
        }

        return "";
    }
}
