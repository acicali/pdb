<?php

class Connection
{
    private static $connection = null;

    public static function connect($configs){
        if(self::$connection){
            return self::$connection;
        }

        return self::$connection = Driver::connect($configs);
    }

    public static function connected(){
        return (bool)self::$connection;
    }
}
