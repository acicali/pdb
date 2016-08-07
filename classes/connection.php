<?php

class Connection
{
    private static $connection = null;

    private final function __construct(){}

    public static function connect(){
        if(! self::$connection){
            $driver = Configs::get('driver');
            $host   = Configs::get('host');
            $user   = Configs::get('user');
            $pass   = Configs::get('pass');

            if(! self::$connection = $driver::connect($host, $user, $pass)){
                throw new Exception('Could not connect with supplied credentials');
            }
        }

        return self::$connection;
    }
}
