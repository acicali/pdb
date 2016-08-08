<?php

if($databaseName = Params::get('database')){
    if($tableName = Params::get('table')){
        $database = new Database($databaseName);
        $table = $database->table($tableName);
        $results = Driver::get_rows(
            $database->name,
            $table->name,
            Params::get('order'),
            Params::get('reverse') == 'true'
        );
        if(empty($results)){
            Route::redirect(
                Params::with('route', 'structure')
                    ->without('order', 'reverse')
                    ->toString()
            );
        }
        View::inject(array(
            'database'  => $database,
            'table'     => $table,
            'columns'   => $table->columns(),
            'results'   => $results
        ))
        ->render('results')
        ->into('main');
    }
}
