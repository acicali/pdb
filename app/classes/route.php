<?php

class Route
{
    private static $data = array();
    private static $instance = false;

    final protected function __construct(){}
	final protected function __clone(){}
	final protected function __wakeup(){}

    public static function instance(){
        if(! static::$instance){
            static::$instance = new static;
        }
        return static::$instance;
    }

    public static function inject($data = array()){
        if(is_array($data)){
            self::$data = array_merge(self::$data, $data);
        }
        return self::instance();
    }

    public static function get(){
        $route = Params::get('route');
        $route = preg_replace('/[^a-z]/', '', $route);
        $route = strtolower($route);
        return $route;
    }

    public static function is($route = null){
        return strtolower($route) === self::get();
    }

    public static function run($route = null){
        if(empty($route)){
            $route = self::get();
        }
        $path = BASEPATH.'routes/'.$route.'.php';
        if(file_exists($path)){
            extract(self::$data);
            require $path;
        }
    }

    public static function redirect($uri){
        header('Location: '.$uri);
        exit();
    }
}
