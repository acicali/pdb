<?php


if($table = Params::get('table')){
    $database = new Database(
        Params::get('database')
    );

    $database
        ->table($table)
        ->truncate();
}

$uri = Params
    ::with('route', 'structure')
    ->toString();

Route::redirect($uri);
