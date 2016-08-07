<?php

class Params
{
    private static $params = array();
    private static $instance = null;

    public static function get($key = null){
        self::boot();
        if(empty($key)){
            return self::$params;
        }

        if(empty(self::$params[$key])){
            return false;
        }

        return self::$params[$key];
    }

    public static function push($key, $value){
        self::boot();
        self::$params[$key] = $value;
    }

    public static function with($key, $value){
        self::boot();
        self::$params[$key] = $value;
        return self::$instance;
    }

    public static function without(){
        self::boot();
        foreach(func_get_args() as $key){
            unset(self::$params[$key]);
        }
        return self::$instance;
    }

    public static function toString($params = null){
        if(empty($params)){
            $params = self::$params;
        }

        // reset the param array from prior calls to with() / without()
        // so that the next chain starts with just those in $_GET
        self::reset();

        if(empty($params)){
            return '/';
        }

        $params = self::sort($params);
        $output = array();

        array_walk($params, function($value, $key) use(& $output){
            $output[] = $key .'='. $value;
        });

        return '/?'.implode('&', $output);
    }

    private static function reset(){
        self::$params = array();
        self::process_query_string();
    }

    private static function boot(){
        if(! self::$instance){
            self::process_query_string();
            self::$instance = new self;
        }
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
