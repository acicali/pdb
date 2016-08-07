<?php

class Database
{
    public function __construct($name = null){
        if(empty($name)){
            throw new Exception('Database name must not be null');
        }

        Connection::connect();
        $this->name = $name;
    }

    public function table($requestedTable = null){
        // fetch the tables if it hasn't already happened
        if(! isset($this->tables)){
            $tables = Driver::tables($this->name);
            foreach($tables as $table){
                $this->tables[$table['name']] = new Table($this, $table['name']);
            }
        }

        // return the requested table if exists
        if(isset($this->tables[$requestedTable])){
            return $this->tables[$requestedTable];
        }

        // requested table does not exist
        return false;
    }

    public function drop(){
        return Driver::query(
            'DROP DATABASE `'.$this->name.'`'
        );
    }
}
