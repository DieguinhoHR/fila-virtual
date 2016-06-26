<?php
declare(strict_types=1);

namespace App\Core\Domain;

class Room
{
	private $id;
	private $createdAt;
	private $updatedAt;
	private $number;
	private $reserved;

	public function getId() : int 
	{
		return $this->id;
	}

	public function setId(int $id)
	{
		$this->id = $id;
	}

	public function getCreatedAt()
	{
		return $this->createdAt;
	}

	public function setCreatedAt($createdAt)
	{
		$this->createdAt = $createdAt;
	}

	public function getUpdatedAt()
	{
		return $this->updatedAt;
	}

	public function setUpdatedAt($updatedAt)
	{
		$this->updatedAt = $updatedAt;
	}

	public function getNumber() : int
	{
		return $this->number;
	}

	public function setNumber(int $number)
	{
		$this->number = $number;
	}

	public function getReserved() : bool
	{
		return $this->reserved;
	}

	public function setReserved(bool $reserved)
	{
		$this->reserved = $reserved;
	}
}