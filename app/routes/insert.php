<?php

if(! empty($_POST)){
    die(var_dump($_POST));
}

View::render('insert')->into('main');
