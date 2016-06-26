<?php
namespace App\Core\Services;

use App\Core\Domain\User;
use App\Core\Repositories\UserPersistence;

class UserService
{	
	private $userPersistence;

	public function __construct(UserPersistence $userPersistence)
	{		
		$this->userPersistence = $userPersistence;
	}

    public function findAll()
    {        
        return $this->userPersistence->findAll();
    }

    public function findBy($id) 
    {
        return $this->userPersistence->findBy($id);
    }

    public function save(User $user)
    {    	
        $this->includeData($user);
        $result = $this->userPersistence->save($user);        
        return $result;
    }

    public function update(User $user) 
    {
        $this->includeData($user);
        $result = $this->userPersistence->update($user);        
        return $result;
    }

    private function includeData(User $user) 
    {
        $user->setUsername($user->getUsername());
        $user->setEmail($user->getEmail());
        $user->setPassword($user->getPassword());
    }

    public function delete($id)
    {
        return $this->userPersistence->delete($id);
    }
}