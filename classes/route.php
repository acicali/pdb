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
}
