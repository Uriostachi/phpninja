<?php

namespace PHPNinja;

class AbstractRepository
{
	private $conn;

	public function __construct($conn)
	{
		$this->conn = $conn;
	}

}