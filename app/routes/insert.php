<?php

if(! empty($_POST['rows'])){
    $keys = array_keys($_POST['rows'][0]);
    $keys = implode("`,`", $keys);
    $rows = array_map(function($row){
        foreach($row as $key => $attrs){
            $attrs['value'] = '"'.$attrs['value'].'"';
            // TODO: this is crude, sometimes the function needs the value
            if(! empty($attrs['function'])){
                $attrs['value'] = $attrs['function'].'()';
            }
            $row[$key] = $attrs['value'];
        }
        return '('.implode(',', $row).')';
    }, $_POST['rows']);

    Driver::execute(
        'INSERT INTO `'
            .$database->name.'`.`'
            .$table->name."` (`"
            .$keys
            ."`) VALUES "
            .implode(',', $rows)
    );

    Route::redirect(
        Params
            ::with('route', 'browse')
            ->toString()
    );
}

View::render('insert')
    ->into('main');
