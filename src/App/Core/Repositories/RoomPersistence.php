<?php
namespace App\Core\Repositories;

use App\Infrastrutucture\Database\Connectors\Connector;
use App\Core\Domain\Room;

use \PDO;

class RoomPersistence 
{	
	private $connector;

	public function __construct(Connector $connector)
	{
		$this->connector = $connector;
	}

	public function findAll() 
	{
		$statement = $this->connector->prepare(
			'SELECT id, created_at, updated_at, number, reserved FROM rooms');      
		$statement->execute();
		$rooms = array();
		while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
			$rooms[] = $row;	
		}	
		return $rooms;
	}

	public function findBy($id) 
	{
		$statement = $this->connector->prepare('
			SELECT id, created_at, updated_at, number, reserved 
			FROM rooms WHERE id = :id');
		$statement->execute([':id' => $id]);
		$results = $statement->fetchAll(PDO::FETCH_OBJ);
		return $results;
	}	

	public function save(Room $room) 
	{
		try {
			$statement =  $this->connector->prepare(
				'INSERT INTO rooms(number, reserved, created_at, updated_at, id_user) 
		         VALUES (:number, :reserved, now(), now(), :id_user)');   
			$number    = $room->getNumber();
			$reserved  = $room->getReserved();			
			$id_user    = 1;

			$statement->bindParam(':number', $number, PDO::PARAM_INT);       
			$statement->bindParam(':reserved', $reserved, PDO::PARAM_INT); 			
			$statement->bindParam(':id_user', $id_user, PDO::PARAM_INT);	
			$statement->execute();	
		} catch(Exception  $e) {
			echo $e->getMessage(); 
		}			
	}

	public function update(Room $room) 
	{
		$statement =  $this->connector->prepare(
			"UPDATE rooms
  			 SET number = :number,
  			     reserved = :reserved,
  			     updated_at = now()			     
			 WHERE id = :id");   

		$number    = $room->getNumber();
		$reserved  = $room->getReserved();					
		$id        = $room->getId();

		$statement->bindParam(':number', $number, PDO::PARAM_INT);       
		$statement->bindParam(':reserved', $reserved, PDO::PARAM_INT); 					
		$statement->bindParam(':id', $id, PDO::PARAM_INT);
		$statement->execute();		
	}

	public function delete($id) 
	{
		$stmt = $this->connector->prepare("DELETE FROM rooms WHERE id = :id");		             
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);   
		$stmt->execute();				
	}	
}