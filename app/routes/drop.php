<?php

// no database specified or found, we shouldn't be here
if(! $database = new Database(Params::get('database'))){
    Route::redirect('/');
}

// no table specified, drop the database and redirect
if(! $table = Params::get('table')){
    $database->drop();
    Route::redirect('/');
}

// table specified, drop the table and redirect
else if($table = $database->table($table)){
    $table->drop();
    Route::redirect(
        Params::without('route', 'table')->toString()
    );
}
