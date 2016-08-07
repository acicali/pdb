<?php

class Pdb
{
    private $view = array();
    private $schema = array();

    public function __construct($configs = null){

        $this->getInstance($configs);

        $params = Params::get();

        if(empty($params)){
            $this->schema['databases'] = $this->__databases($configs);
        }
        // process query strings
        array_walk($params, array($this, 'processGetVar'));

        $this->view['schema'] = $this->schema;
        $this->view['host'] = $configs['host'];

        View::show('index', $this->view);
    }

    private function getInstance($configs){
        $this->instance = new $configs['driver']();
        $this->connection = $this->instance->connect(
            $configs['host'],
            $configs['user'],
            $configs['pass']
        );
        if(! $this->connection){
            throw new Exception('Could not connect to database');
        }

        if(empty($configs['theme'])){
            $configs['theme'] = 'default';
        }

        $this->view['theme'] = $configs['theme'];
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
