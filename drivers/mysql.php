<?php

class mysql
{
    public function connect($host, $user, $pass){
        return $this->connection = mysql_connect($host, $user, $pass);
    }

    public function databases(){
        $databases = array();

        $results = mysql_query(
            'SHOW DATABASES'
        );

        while($row = mysql_fetch_row($results)){
            $databases[] = $row[0];
        }

        return $databases;
    }

    public function tables($database){
        $tables = array();

        $results = mysql_query(
            'SELECT
                `table_name` AS `name`,
                `engine`,
                `table_rows` AS `records`,
                `table_collation` AS `collation`,
                `table_comment` AS `comments`
                FROM `information_schema`.`tables`
                WHERE `table_schema` = "'.$database.'"'
        );

        while($row = mysql_fetch_assoc($results)){
            $tables[] = $row;
        }

        return $tables;
    }

    public function columns($database, $table){
        $columns = array();

        $results = mysql_query(
            'SELECT
                `column_name` AS `field`,
                `collation_name` AS `collation`,
                `column_type` AS `attributes`,
                `is_nullable` AS `null`,
                `column_default` AS `default`,
                `extra`,
                `column_key` AS `key`
                FROM `information_schema`.`columns`
                WHERE `table_schema` = "'.$this->escape($database).'"
                    AND `table_name` = "'.$this->escape($table).'"
                ORDER BY `ordinal_position`'
        );

        while($row = mysql_fetch_assoc($results)){
            // get the type from `column_type` instead of
            // `data_type` because it also includes the length
            $attributes = explode(' ', $row['attributes']);
            $row['type'] = array_shift($attributes);
            $row['attributes'] = implode(' ', $attributes);

            $row['null'] = strtolower($row['null']) === 'yes';
            $row['attributes'] = strtoupper($row['attributes']);
            $row['extra'] = strtoupper($row['extra']);

            $columns[] = $row;
        }

        return $columns;
    }

    public function rows($database = null, $table = null, $order = null, $limit = null){
        $rows = array();

        if(empty($database)){
            return false;
        }

        if(empty($table)){
            return false;
        }

        $query = 'SELECT *
            FROM `'.$this->escape($database).'`.`'.$this->escape($table).'`';

        if(! empty($order)){
            $query .= ' ORDER BY `'.$this->escape($order).'`';
        }

        $results = mysql_query($query);

        while($row = mysql_fetch_assoc($results)){
            $rows[] = $row;
        }

        return $rows;
    }

    public function execute($database, $query){

    }

    public function count($database, $query){

    }

    public function escape($param){
        return mysql_real_escape_string($param);
    }
}
