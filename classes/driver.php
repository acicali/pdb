<?php

class Driver
{
    private static $loadedDrivers = array();

    public static function __callStatic($func, $args){
        $driver = Configs::get('driver');
        if(empty(self::$loadedDrivers[$driver])){
            $path = BASEPATH.'drivers/';
            $filename = $driver.'.php';
            self::$loadedDrivers[$driver] = require $path.$filename;
        }
        return call_user_func_array(array($driver, $func), $args);
    }
}
