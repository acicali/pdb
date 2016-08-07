<?php

if(! empty($_POST['query'])){
    //Driver::query($_POST['query']);
    Route::redirect(
       Params
            ::with('route', 'results')
            ->with('query', urlencode($_POST['query']))
            ->toString()
    );
}

View::render('query')
    ->into('main');
