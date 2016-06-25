<?php
declare(strict_types=1);

namespace App\Core\Domain;

class User
{
	private $id;
	private $username;
	private $password;
	private $email;

	public function getId() : int 
	{
		return $this->id;
	}

	public function setId(int $id)
	{
		$this->id = $id;
	}

	public function getUsername() : string
	{
		return $this->username;
	}

	public function setUsername(string $username)
	{
		$this->username = $username;
	}

	public function getPassword() : string 
	{
		return $this->password;
	}

	public function setPassword(string $password)
	{
		$this->password = $password;
	}

	public function getEmail() : string 
	{
		return $this->email;
	}

	public function setEmail(string $email)
	{
		$this->email = $email;
	}
}