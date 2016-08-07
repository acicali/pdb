<?php

class Configs
{
    public static function get($name = null){
        $configs = self::custom();

        if(empty($configs)){
            $configs = self::auto();
        }

        if(empty($name)){
            return $configs;
        }

        if(empty($configs[$name])){
            return false;
        }

        return $configs[$name];
    }

    private static function custom(){
        $configs = array();

        if(file_exists(BASEPATH.'config.php')){
            require BASEPATH.'config.php';
        }

        if(! self::valid($configs)){
            return false;
        }

        return $configs;
    }

    private static function auto(){
        // TODO: check for running database servers and auto generate configs
    }

    private static function valid($configs){
        // TODO: validate custom configs
        return true;
    }
}
