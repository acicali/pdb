<?php

if($databaseName = Params::get('database')){
    $database = new Database($databaseName);
    if($query = Params::get('query')){
        $query = Params::decode($query);
        $results = Driver::query($query);
        View::inject(array(
            'database'  => $database,
            'query'     => $query,
            'results'   => $results
        ))
        ->render('results')
        ->into('main');
    }
    else if($tableName = Params::get('table')){
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
            'results'   => $results
        ))
        ->render('results')
        ->into('main');
    }
}
