<?php

if(! Params::get('database')){
    Route::redirect('/');
}

if(! Params::get('table')){
    Route::redirect(
        Params::only('database')->toString()
    );
}

$results = $table->rows(Params::get());
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
