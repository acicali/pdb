<?php

define('BASEPATH', dirname(__FILE__).'/');

function __autoload($class){
    $dirs = array(
        'classes',
        'drivers',
        'drivers/mysql'
    );

    $class = strtolower($class);
    $file = $class.'.php';
    foreach($dirs as $dir){
        if(file_exists($dir.'/'.$file)){
            require $dir.'/'.$file;
        }
    }
}
