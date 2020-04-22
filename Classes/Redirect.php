<?php

class Redirect
{
    //The method takes you to another webpage.
    public static function to($location = null)
    {
        if ($location) {
            header('Location:' . $location);
            exit();
        }
    }
}