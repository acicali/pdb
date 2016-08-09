<?php

if(! empty($_POST['query'])){
    Route::redirect(
       Params
            ::with('route', 'results')
            ->with('query', Params::encode($_POST['query']))
            ->toString()
    );
}

View::render('query')
    ->into('main');
