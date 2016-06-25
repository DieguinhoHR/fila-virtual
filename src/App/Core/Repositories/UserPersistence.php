<?php

namespace App\Core\Repositories;

use App\Infrastrutucture\Database\Connectors\Connector;

class UserPersistence implements UserRepository
{	
	private $connector;

	public function __construct(Connector $connector)
	{
		$this->connector = $connector;
	}

	public function findAll() 
	{
		$statement = $this->connector->prepare('SELECT username, email FROM users');      
		$statement->execute();
		$users = array();
		while($row = $$statement->fetch(PDO::FETCH_ASSOC)) {
			$users[] = $row;	
		}	
		return $users;
	}

	public function findBy($id) 
	{

	}	

	public function save(User $user) 
	{
		try {
			$statement = $this->connector->prepare("INSERT INTO users (username, email, password)
			             					        VALUES (:username, :email, :password)");            
			$statement->bindParam(':username', $user->getUsername(), PDO::PARAM_STR);       
			$statement->bindParam(':email', $user->getEmail(), PDO::PARAM_STR); 
			$statement->bindParam(':password', $user->getPassword(), PDO::PARAM_STR);	
			$statement->execute();
		} catch(Exception  $e) {
			echo $e->getMessage(); 
		}			
	}

	public function update(User $user) 
	{

	}

	public function delete($id) 
	{

	}		
}