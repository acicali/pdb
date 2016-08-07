<?php

// TODO: clean up

define('BASEPATH', dirname(__FILE__).'/');

require 'autoload.php';

Connection::connect();

$viewData = array(
    'databases' => array_filter(
        Driver::get_databases(),
        function($database){
            $hide = Configs::get('hide');
            return ! (is_array($hide) AND in_array($database, $hide));
        }
    ),
    'database' => Params::get('database')
        ? new Database(Params::get('database'))
        : false
);

View::render('breadcrumbs', 'tabs')
    ->into('right')
    ->inject($viewData)
    ->render('databases')
    ->into('left');

Route::run();

View::output('index');
