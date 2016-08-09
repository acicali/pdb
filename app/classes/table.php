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
