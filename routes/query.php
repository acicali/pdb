<?php

if(! empty($_POST['query'])){
    Driver::query($_POST['query']);

    Route::redirect(
       Params::with('route', 'results')->toString()
    );
}
