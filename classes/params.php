<?php

class Params
{
    private static $params = array();
    private static $instance = null;

    public static function get($name = null){
        self::boot();
        if(empty($name)){
            return self::$params;
        }

        if(empty(self::$params[$name])){
            return false;
        }

        return self::$params[$name];
    }

    public static function push($name, $value){
        self::boot();
        self::$params[$name] = $value;
    }

    public static function with($name, $value){
        self::boot();
        self::$params[$name] = $value;
        return self::$instance;
    }

    public static function without($name){
        self::boot();
        unset(self::$params[$name]);
        return self::$instance;
    }

    private static function boot(){
        self::process_query_string();
        if(! self::$instance){
            self::$instance = new self;
        }
    }

    public static function toString($params = null){
        if(empty($params)){
            $params = self::$params;
        }

        // resets the param array from prior calls to with() / without()
        // so that the next chain starts with just those in $_GET
        self::$params = array();

        if(empty($params)){
            return false;
        }

        $params = self::sort($params);
        $output = array();

        array_walk($params, function($value, $name) use(& $output){
            $output[] = $name .'='. $value;
        });

        return '?'.implode('&', $output);
    }

    private static function process_query_string(){
        self::$params = array_merge(
            self::$params, $_GET
        );
    }

    private static function sort($params = array()){
        $keys = array(
            'route',
            'database',
            'table',
            'order'
        );

        $sorted = array();

        foreach($keys as $key){
            if(! empty($params[$key])){
                $sorted[$key] = $params[$key];
            }
        }

        return $sorted;
    }
}
