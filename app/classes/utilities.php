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
}
