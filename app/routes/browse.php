<?php

if(! Params::get('database')){
    Route::redirect('/');
}

if(! Params::get('table')){
    Route::redirect(
        Params::only('database')->toString()
    );
}

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
        'results' => $results
    ))
    ->render('results')
    ->into('main');
