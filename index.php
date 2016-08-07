<?php

require 'autoload.php';

Connection::connect();

$databases = array_filter(
    Driver::get_databases(),
    function($database){
        $hide = Configs::get('hide');
        return ! (is_array($hide) AND in_array($database, $hide));
    }
);

View::render('breadcrumbs', 'tabs')
    ->into('right')
    ->inject(array('databases' => $databases))
    ->render('databases')
    ->into('left');

Route::run();

View::output('index');
