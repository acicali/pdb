<?php

class Table
{
    public function __construct($database = null, $name = null){
        $this->database = $database;
        $this->name = $name;
    }

    public function drop(){
        return Driver::query(
            'DROP TABLE `'.$this->database->name.'`.`'.$this->name.'`'
        );
    }

    public function truncate(){
        return Driver::query(
            'TRUNCATE TABLE `'.$this->database->name.'`.`'.$this->name.'`'
        );
    }
}
