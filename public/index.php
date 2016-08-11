<?php

// TODO: clean up

define('BASEPATH', __DIR__.'/../app/');
require BASEPATH.'autoload.php';
if(file_exists(BASEPATH.'config.php')){
    require BASEPATH.'config.php';
}





//CONNECT TO AND FETCH DATABASE NAMES FROM POSTGRES
// $connection = \Doctrine\DBAL\DriverManager::getConnection(
//     array(
//         'driver'    => 'pdo_pgsql',
//         'user'      => 'postgres',
//         'password'  => 'okcomp',
// //        'dbname'    => 'testing',
// //        'host'      => 'localhost',
// //        'port'      => '5432',
// //        'charset'   => 'utf8'
//     ),
//     new \Doctrine\DBAL\Configuration()
// );
// $schema = $connection->getSchemaManager();
// $databases = $schema->listDatabases();
// die(var_dump($databases));





// if the configs contain a user, they
// came from config.php, connect away
if(Configs::get('user')){
    Connection::connect(Configs::get());
}
// otherwise if the configs have a matching cookie,
// decrypt it and we should have working credentials
else if($key = md5(json_encode(Configs::get())) AND ! empty($_COOKIE[$key])){
    $decrypted = Utilities::decrypt($key, $_COOKIE[$key]);
    $configs = json_decode($decrypted, true);
    // TODO: if the cookie is somehow changed and does
    // not produce credentials, we should unset it
    Connection::connect($configs);
}
// if no credentials were found from the above methods,
// display the login screen so the user can supply them
else {
    Route::run('login');
}




if(Connection::connected()){
    // get a list of databases
    $databases = array_filter(
        Driver::get_databases(),
        function($database){
            $hide = Configs::get('hide');
            return ! (is_array($hide) AND in_array($database, $hide));
        }
    );

    // get the selected database or NULL
    $database = Params::get('database')
        ? new Database(Params::get('database'))
        : null;

    // get the selected table or NULL
    $table = ($database AND Params::get('table'))
        ? $database->table(Params::get('table'))
        : null;

    Route::inject(array(
        'databases' => $databases,
        'database'  => $database,
        'table'     => $table
    ));

    View::inject(array(
        'databases' => $databases,
        'database'  => $database,
        'table'     => $table
    ))
    ->render('databases')
    ->into('left')
    ->render('breadcrumbs', 'tabs')
    ->into('main');

    Route::run();
}




View::send('index');
