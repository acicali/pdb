<?php

class Route
{
    public static function get(){
        $route = Params::get('route');
        $route = preg_replace('/[^a-z]/', '', $route);
        $route = strtolower($route);
        if(empty($route)){
            $route = self::getDefault();
        }
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
            require $path;
        }
    }

    public static function redirect($uri){
        header('Location: '.$uri);
        exit();
    }

    private static function getDefault(){
        return 'structure';
    }
}
