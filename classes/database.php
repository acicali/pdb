<?php

class Database extends Cacheable
{
    public function __construct($name = null){
        if(empty($name)){
            throw new Exception('Database name must not be null');
        }

        Connection::connect();
        Driver::select_database($name);
        $this->name = $name;
    }

    public function tables(){
        $self = $this;
        return $this->fromCache('tables', function() use($self){
            return array_map(function($table) use($self){
                return new Table($self, $table['name']);
            }, Driver::get_tables($self->name));
        });
    }

    public function table($requestedTable = null){
        foreach($this->tables() as $table){
            if($table->name == $requestedTable){
                return $table;
            }
        }

        return false;
    }

    public function drop(){
        return Driver::drop_database($this->name);
    }
}
