<?php

if($databaseName = Params::get('database')){
    if($tableName = Params::get('table')){
        $database = new Database($databaseName);
        $table = $database->table($tableName);
        View::inject(array(
            'database'  => $database,
            'table'     => $table,
            'columns'   => $table->columns()
        ))
        ->render('structure')
        ->into('main');
    }
}
