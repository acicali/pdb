<?php

class Cacheable
{
    private $cache = array();

    protected function fromCache($entry, $callable){
        if(empty($this->cache[$entry])){
            $this->cache[$entry] = $callable();
        }
        return $this->cache[$entry];
    }
}
