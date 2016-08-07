<?php

class Driver
{
    public static function __callStatic($func, $args){
        return call_user_func_array(
            array(Configs::get('driver'), $func), $args
        );
    }
}
