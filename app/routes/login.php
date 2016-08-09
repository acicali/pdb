<?php

// show the login view
if(empty($_POST['credentials'])){
    return View::render('login')
        ->into('main');
}

// or upon successful submission of credentials,
// store the credentials and redirect to home
$configs = Configs::get();
$configsHashed = md5(json_encode($configs));
$credentials = array_intersect_key(
    $_POST, array_flip(array('user', 'pass'))
);
$configsModified = array_merge($configs, $credentials);
$connected = Driver::connect(
    $configsModified['host'],
    $configsModified['user'],
    $configsModified['pass']
);
if($connected){
    $configsEncrypted = openssl_encrypt(
        json_encode($configsModified),
        'AES-256-CTR',
        $configsHashed
    );
    setcookie($configsHashed, $configsEncrypted,
        null, null, null, null, true); // httponly: true
}

Route::redirect('/');
