<?php

class Singleton
{
    private static $instance = false;
    private function __construct(){}

    public static function instance(){
        if(! self::$instance){
            self::$instance = new static;
        }
        return self::$instance;
    }
}
