<?php

// TODO: clean up

define('BASEPATH', dirname(__FILE__).'/');

require 'autoload.php';

if(file_exists(BASEPATH.'config.php')){
    require BASEPATH.'config.php';
}

if(Configs::get('user')){
    Connection::connect(
        Configs::get('host'),
        Configs::get('user'),
        Configs::get('pass')
    );

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

    View::inject($viewData)
        ->render('databases')
        ->into('left')
        ->render('breadcrumbs', 'tabs')
        ->into('main');

    Route::run();
}
else {
    $configsHashed = md5(json_encode(Configs::get()));
    if(empty($_COOKIE[$configsHashed])){
        Route::run('login');
    }
    else {
        $configs = $_COOKIE[$configsHashed];
        $decrypted = openssl_decrypt(
            $configs,
            'AES-256-CTR',
            $configsHashed
        );
        $configs = json_decode($decrypted, true);

        Connection::connect(
            $configs['host'],
            $configs['user'],
            $configs['pass']
        );

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

        View::inject($viewData)
            ->render('databases')
            ->into('left')
            ->render('breadcrumbs', 'tabs')
            ->into('main');

        Route::run();
    }
}

View::send('index');
