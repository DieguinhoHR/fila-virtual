<?php
namespace App\Core\Repositories;

use App\Infrastrutucture\Database\Connectors\Connector;
use App\Core\Domain\Room;

use \PDO;

class AuthPersistence 
{	
	private $connector;

	public function __construct(Connector $connector)
	{
		$this->connector = $connector;
	}

	public function findBy($email, $password) 
	{
		$statement = $this->connector->prepare(
			"SELECT email, password 
			 FROM users 
			 WHERE email = :email
			 AND password = :password");
		$statement->execute([':email' => $email, ':password' => $password]);
		
		$results = $statement->fetchAll(PDO::FETCH_OBJ);
		return $results;
	}	
}