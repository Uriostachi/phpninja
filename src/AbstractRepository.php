<?php

namespace PHPNinja;

class AbstractRepository
{
	protected $conn;

	public function __construct($conn)
	{
		$this->conn = $conn;
	}

}