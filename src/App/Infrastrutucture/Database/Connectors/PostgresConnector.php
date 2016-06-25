<?php

namespace App\Infrastrutucture\Database\Connectors;

use \PDO;

class PostgresConnector extends Connector implements IConnector
{   
    public function connect(array $config)
    {   
        try {  	  	
            $connect = $this->createConnect(
                'postgre:' . $config['dsn'], $config['user'], $config['password']);
       	} catch (Exception $e) {
            echo $e->getMessage();
        }
        return $connect;
    }   
}