<?php

class Route
{
    public static function get(){
        $route = Params::get('route');
        if(empty($route)){
            $route = 'structure';
        }
        return $route;
    }

    public static function is($route = null){
        return $route === Params::get('route');
    }

    public static function run(){
        $route = self::get();
    }
}
