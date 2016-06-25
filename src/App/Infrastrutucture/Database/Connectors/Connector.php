<?php

namespace App\Infrastrutucture\Database\Connectors;

use \PDO;

class Connector
{	
	protected $conn;

	public function createConnect($dsn, $user, $password)
	{
		try {
    		$this->conn = new PDO($dsn, $user, $password);    
    		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
    		echo $e->getMessage();
		}
	}

	public function prepare($query)
	{
		return $this->conn->prepare($query);
	}
}