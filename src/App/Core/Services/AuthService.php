<?php
namespace App\Core\Services;

use App\Core\Domain\Room;
use App\Core\Repositories\AuthPersistence;

class AuthService
{	
	private $authPersistence;

	public function __construct(AuthPersistence $authPersistence)
	{		
		$this->authPersistence = $authPersistence;
	}

    public function findBy($email, $password)
    {
        return $this->authPersistence->findBy($email, $password);
    }    
}