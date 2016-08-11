<?php

class Configs
{
    private static $configsArray = array();

    public static function push($configs){
        self::$configsArray[] = $configs;
    }

    public static function get($name = null){
        if(empty(self::$configsArray)){
            self::auto();
        }

        if(empty(self::$configsArray)){
            throw new Exception('No valid configs could be found or determined');
        }

        $configs = self::$configsArray[0];

        if(empty($name)){
            return $configs;
        }

        if(empty($configs[$name])){
            return false;
        }

        return $configs[$name];
    }

    public static function all(){
        return self::$configsArray;
    }

    private static function auto(){
        self::$configsArray[] = array(
            'host'  => 'localhost',
            'hide'  => array(
                'mysql',
                'information_schema'
            ),
            'driver'    => 'mysql',
            'theme'     => 'pma'
        );

        // self::$configsArray[] = array(
        //     'host'  => 'localhost',
        //     'hide'  => array(
        //         'template1'
        //     ),
        //     'driver'    => 'postgresql',
        //     'theme'     => 'pma'
        // );

        // TODO: check for running database servers and auto generate configs
    }

    private static function valid($configs){
        // TODO: validate custom configs
        return true;
    }
}
