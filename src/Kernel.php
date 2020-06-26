<?php

namespace PHPNinja;

use App\Controller\Home;

class Kernel 
{
	private $router;

	public function __construct()
	{
		$this->router = new Router;
	}

	public function getRouter() 
	{
		return $this->router;
	}
}


