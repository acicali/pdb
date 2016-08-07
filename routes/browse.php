<?php

if($databaseName = Params::get('database')){
    if($tableName = Params::get('table')){
        $database = new Database($databaseName);
        $table = $database->table($tableName);
        View::inject(array(
            'database'  => $database,
            'table'     => $table,
            'columns'   => $table->columns(),
            'results'   => Driver::get_rows(
                $database->name,
                $table->name,
                Params::get('order')
            )
        ))
        ->render('results')
        ->into('main');
    }
}
