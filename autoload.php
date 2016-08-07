<?php

function __autoload($class){
    $class = strtolower($class);
    $filename = $class.'.php';
    $path = BASEPATH.'classes/';
    if(file_exists($path.$filename)){
        require $path.$filename;
    }
}
