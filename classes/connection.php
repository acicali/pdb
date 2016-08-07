<?php

class Connection extends Singleton
{
    private static $connection = null;

    public static function connect(){
        if(self::$connection){
            return self::$connection;
        }

        self::$connection =
            Driver::connect(
                Configs::get('host'),
                Configs::get('user'),
                Configs::get('pass')
            );
    }
}
