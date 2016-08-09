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

    final protected function __construct(){}
	final protected function __clone(){}
	final protected function __wakeup(){}
}
