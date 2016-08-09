<?php

// no credentials submitted, display the login view and leave
if(empty($_POST['credentials'])){
    return View::render('login')
        ->into('main');
}


// credentials supplied via login form
$credentials = array_intersect_key(
    $_POST, array_flip(array('user', 'pass'))
);


// configs from file or auto (no credentials supplied)
$configs = Configs::get();


// hash of the configs
$key = md5(json_encode($configs));


// configs merge with credentials
$configs = array_merge($configs, $credentials);


// if the supplied credentials worked,
// save them in a cookie for this session
if(Driver::connect($configs)){
    $encrypted = Utilities::encrypt($key, json_encode($configs));
    Cookie::set($key, $encrypted);
}


// TODO: display an error when credentials fail


// redirect home again
Route::redirect('/');
