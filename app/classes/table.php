<?php

class Table extends Cacheable
{
    public function __construct($database = null, $name = null){
        $this->database = $database;
        $this->name = $name;
    }

    public function columns(){
        $self = $this;
        return $this->fromCache('columns', function() use($self){
            return Driver::get_columns(
                $self->database->name, $self->name
            );
        });
    }

    public function rows($params = null){
        // default parameters
        $params = array_merge(array(
            'database'  => $this->database->name,
            'table'     => $this->name,
            'order'     => false,
            'reverse'   => false,
            'limit'     => 50,
            'offset'    => 0
        ), $params);
        $query = Driver::get_rows();
        $mustache = new Mustache_Engine;
        return Driver::query(
            $mustache->render($query, $params)
        );
    }

    public function count(){
        $params = array(
            'database'  => $this->database->name,
            'table'     => $this->name
        );
        $query = Driver::get_row_count();
        $mustache = new Mustache_Engine;
        $results = Driver::query(
            $mustache->render($query, $params)
        );
        return $results[0]['count'];
    }

    public function drop(){
        return Driver::drop_table(
            $this->database->name, $this->name
        );
    }

    public function truncate(){
        return Driver::truncate_table(
            $this->database->name, $this->name
        );
    }
}
