<?php

class Singleton
{
    protected static $instance = false;

    public static function instance(){
        if(! static::$instance){
            static::$instance = new static;
        }
        return static::$instance;
    }
}
