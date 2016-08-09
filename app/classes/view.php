<?php

class View extends Singleton
{
    private static $data = array();
    private static $rendered = array();
    private static $renderedInto = array();

    public static function inject($data = array()){
        if(is_array($data)){
            self::$data = array_merge(self::$data, $data);
        }
        return self::instance();
    }

    public static function send($view = null){
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

    public static function position($position = null){
        if(! self::positionEmpty($position)){
            echo implode('', self::$renderedInto[$position]);
        }
    }

    public static function positionEmpty($name = null){
        return empty($name)
            OR empty(self::$renderedInto[$name]);
    }

    public static function exists($view = null){
        return file_exists(self::path($view));
    }

    private static function path($view = null){
        return BASEPATH.'views/'.$view.'.php';;
    }

    private static function reset(){
        self::$rendered = array();
    }

    private static function getRenderedView($name = null){
        if(! self::exists($name)){
            return false;
        }
        extract(self::$data);
        ob_start();
        require self::path($name);
        return ob_get_clean();
    }
}
