<?php

class Pdb
{
    private $view = array();
    private $schema = array();

    public function __construct($configs = null){

        Connection::connect();

        $this->getInstance($configs);
        Route::run();
        $params = Params::get();
        $this->schema['databases'] = $this->__databases($configs);

        // process query strings
        array_walk($params, array($this, 'processGetVar'));

        $this->view['schema'] = $this->schema;

        View::render('index', $this->view);
    }

    private function getInstance($configs){
        $this->instance = new $configs['driver']();
    }

    private function processGetVar($value, $key){
        $method = '__'.$key;
        if(method_exists($this, $method)){
            $this->$method($value);
        }
    }

    private function __databases($configs){
        $databases = $this->instance->databases();
        if(! empty($configs['hide']) AND is_array($configs['hide'])){
            $databases = array_diff(
                $databases,
                $configs['hide']
            );
        }
        return $databases;
    }

    private function __database($database = null){
        $this->schema['database'] = $database;
        $this->schema['tables'] = $this->instance->tables($database);
    }

    private function __table($table = null){
        $this->schema['table'] = $table;

        if(empty($this->schema['database'])){
            return false;
        }

        $this->schema['columns'] = $this->instance->columns(
            $this->schema['database'],
            $table
        );

        $this->schema['results'] = $this->instance->rows(
            $this->schema['database'],
            $table,
            Params::get('order')
        );
    }
}
