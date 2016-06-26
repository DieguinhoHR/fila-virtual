<?php
namespace App\Core\Services;

use App\Core\Domain\Room;
use App\Core\Repositories\RoomPersistence;

class RoomService
{	
	private $roomPersistence;

	public function __construct(RoomPersistence $roomPersistence)
	{		
		$this->roomPersistence = $roomPersistence;
	}

    public function findAll()
    {
        return $this->roomPersistence->findAll();
    }

    public function findBy($id) 
    {
        return $this->roomPersistence->findBy($id);
    }

    public function save(Room $room)
    {    	
        $room->setCreatedAt($room->getCreatedAt());
        $room->setNumber($room->getNumber());
        $room->setReserved($room->getReserved());     
        $result = $this->roomPersistence->save($room);        
        return $result;
    }

    public function update(Room $room) 
    {
        return $this->roomPersistence->update($room);             
    }

    public function delete($id)
    {
        return $this->roomPersistence->delete($id);
    }
}