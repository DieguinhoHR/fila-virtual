<?php

namespace App\Infrastrutucture\Database\Connectors;

use \PDO;

class MysqlConnector extends Connector implements IConnector
{	    
    public function connect(array $config)
    {   
        try {  	  	
            $connect = $this->createConnect(
                'mysql:' . $config['dsn'], $config['user'], $config['password']);
       	} catch (Exception $e) {
            echo $e->getMessage();
        }
        return $connect;
    }

    public function lastInsertId()
	{
	   return $this->conn->lastInsertId();
    }
}