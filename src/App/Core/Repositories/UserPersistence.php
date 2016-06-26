<?php
namespace App\Core\Repositories;

use App\Infrastrutucture\Database\Connectors\Connector;
use App\Core\Domain\User;
use App\Core\Repositories\UserRepository;

use \PDO;

class UserPersistence 
{	
	private $connector;

	public function __construct(Connector $connector)
	{
		$this->connector = $connector;
	}

	public function findAll() 
	{
		$statement = $this->connector->prepare('SELECT id, username, email FROM users');      
		$statement->execute();
		$users = array();
		while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
			$users[] = $row;	
		}	
		return $users;
	}

	public function findBy($id) 
	{
		$statement = $this->connector->prepare('SELECT id, username, email, password 
			                                    FROM users 
			                                    WHERE id = :id');
		$statement->execute([':id' => $id]);
		$results = $statement->fetchAll(PDO::FETCH_OBJ);

		return $results;
	}	

	public function save(User $user) 
	{
		try {
			$this->queryExecute($user);
		} catch(Exception  $e) {
			echo $e->getMessage(); 
		}			
	}

	private function queryExecute(User $user)
	{		
		$statement =  $this->connector->prepare(
			'INSERT INTO users (username, email, password) VALUES (:username, :email, :password)');   
		$username =  $user->getUsername();
		$email = $user->getEmail();
		$password = $user->getPassword();

		$statement->bindParam(':username', $username, PDO::PARAM_STR);       
		$statement->bindParam(':email', $email, PDO::PARAM_STR); 
		$statement->bindParam(':password', $password, PDO::PARAM_STR);	
		$statement->execute();
	}

	public function update(User $user) 
	{
		$statement =  $this->connector->prepare(
			"UPDATE users 
  			 SET username = :username, 
			     email = :email,
			     password = :password
			 WHERE id = :id");   

		$username =  $user->getUsername();
		$email = $user->getEmail();
		$password = $user->getPassword();
		$id = $user->getId();

		$statement->bindParam(':username', $username, PDO::PARAM_STR);       
		$statement->bindParam(':email', $email, PDO::PARAM_STR); 
		$statement->bindParam(':password', $password, PDO::PARAM_STR);	
		$statement->bindParam(':id', $id, PDO::PARAM_INT);
		$statement->execute();		
	}

	public function delete($id) 
	{
		$stmt = $this->connector->prepare("DELETE FROM users WHERE id = :id");		             
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);   
		$stmt->execute();				
	}	
}