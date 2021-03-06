<?php

class Utilities
{
    public static function array_pluck($array = array(), $keys = array()){
        $values = array();
        foreach($keys as $key){
            if(array_key_exists($key, $array)){
                $values[] = $array[$key];
            }
        }
        return $values;
    }

    public static function encode($string){
        return strtr(base64_encode($string), '+/=', '-_~');
    }

    public static function decode($string){
        return base64_decode(strtr($string, '-_~', '+/='));
    }

    public static function encrypt($key = null, $string = null){
        return openssl_encrypt($string, 'AES-256-CTR', 'salty-d0g'.$key);
    }

    public static function decrypt($key = null, $string = null){
        return openssl_decrypt($string, 'AES-256-CTR', 'salty-d0g'.$key);
    }
}
