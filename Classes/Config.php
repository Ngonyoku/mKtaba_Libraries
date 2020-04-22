<?php

class Config
{
    public static function get($path = null)
    {
        if ($path) {
            $config = $GLOBALS['Config'];
            $path = explode('/', $path);

            foreach ($path as $bit) {
                if (isset($config[$bit])) {
                    $config = $config[$bit];
                }
            }
            return $config;
        }

        return false;
    }
}
