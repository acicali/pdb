<?php

class Cookie
{
    public static function get($key = null){
        if(! empty($_COOKIE[$key])){
            return $_COOKIE[$key];
        }
        return false;
    }

    public static function set($key = null, $value = null, $expiration = null){
        if(empty($key)){
            throw new Exception('Cookie key must not be empty');
        }
        return setcookie($key, $value,
            $expiration,    // expiration, defaults to "when the browser closes"
            null,           // path
            null,           // domain
            null,           // secure
            true            // httponly
        );
    }
}
