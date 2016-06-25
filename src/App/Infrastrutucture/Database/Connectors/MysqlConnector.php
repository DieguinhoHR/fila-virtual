<?php

namespace App\Infrastrutucture\Database\Connectors;

use \PDO;

class MysqlConnector extends Connector implements IConnector
{	  
    /**
     * Establish a database connection.
     *
     * @param  array  $config
     * @return \PDO
     */
    public function connect(array $config)
    {   
        try {  	  	
            $connect = $this->createConnect($config['dsn'], $config['user'], $config['password']);
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