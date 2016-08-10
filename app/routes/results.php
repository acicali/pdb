<?php

if(! Params::get('database')){
    Route::redirect('/');
}


$query = Params::get('query');
if($query){
    $query = Utilities::decode($query);
    $results = Driver::query($query);
    $query = SqlFormatter::format($query);
}
View::inject(array(
    'query'     => $query,
    'results'   => $results
))
->render('results')
->into('main');
