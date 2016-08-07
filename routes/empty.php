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
    ::without('route')
    ->toString();

Route::redirect($uri);
