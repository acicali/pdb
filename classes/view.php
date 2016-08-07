<?php

class View
{
    public static function show($view, $data = array()){
        $path = BASEPATH.'views/'.$view.'.php';
        if(! file_exists($path)){
            return false;
        }
        extract($data);
        unset($data);
        ob_start();
        require $path;
        ob_get_flush();
    }
}
