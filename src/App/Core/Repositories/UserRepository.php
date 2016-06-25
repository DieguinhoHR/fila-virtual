<?php
namespace App\Core\Repositories;

interface UserRepository
{	
	function findAll();		
	function findBy($id);	
	function save(User $user);
	function update(User $user);
	function delete($id);		
}