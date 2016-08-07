<?php

class View extends Singleton
{
    private static $data = array();
    private static $rendered = array();
    private static $renderedInto = array();

    public static function inject($data = array()){
        if(is_array($data)){
            self::$data[] = $data;
        }
        return self::instance();
    }

    public static function output($view = null){
        echo self::getRenderedView($view);
        self::reset();
    }

    public static function render(){
        foreach(func_get_args() as $view){
            self::$rendered[] = self::getRenderedView($view);
        }
        return self::instance();
    }

    public static function into($position = null){
        if(empty($position)){
            throw new Exception('Parameter `position` required');
        }
        if(empty(self::$renderedInto[$position])){
            self::$renderedInto[$position] = array();
        }
        foreach(self::$rendered as $render){
            self::$renderedInto[$position][] = $render;
        }
        self::reset();
        return self::instance();
    }

    public static function position($name = null){
        if(empty($name) OR empty(self::$renderedInto[$name])){
            return false;
        }
        echo implode('', self::$renderedInto[$name]);
    }

    private static function reset(){
        self::$data = array();
        self::$rendered = array();
    }

    private static function getRenderedView($view){
        $path = BASEPATH.'views/'.$view.'.php';
        if(! file_exists($path)){
            return false;
        }
        foreach(self::$data as $data){
            extract($data);
        }
        ob_start();
        require $path;
        return ob_get_clean();
    }
}
