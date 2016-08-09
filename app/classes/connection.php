<?php

class Connection extends Singleton
{
    private static $connection = null;

    public static function connect($host = null, $user = null, $pass = null){
        if(self::$connection){
            return self::$connection;
        }

        self::$connection =
            Driver::connect($host, $user, $pass);
    }

    public static function connected(){
        return (bool)self::$connection;
    }
}
