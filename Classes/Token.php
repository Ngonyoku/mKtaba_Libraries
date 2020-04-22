<?php

class Token
{
    //This method will generate our Token
    public static function generate()
    {
        return Session::set(Config::get('session/token_name'), md5(uniqid()));
    }

    //The method will create a new Session if it alredy Exists.
    public static function check($token)
    {
        $tokenName = Config::get('session/token_name');

        if (Session::exists($tokenName) && $token == Session::get($tokenName)) {
            Session::delete($tokenName);
            return true;
        }

        return false;
    }
}
