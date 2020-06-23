<?php

namespace PHPNinja;

class DBConnect
{
	private static $instance;

	private final function __construct()
	{
		//echo __CLASS__ . ' initialize only once';
	}

	public static function getInstance() 
	{
		if (!isset(self::$instance)) {
			self::$instance = new DBConnect();
		}

		return self::$instance;
	}

	public function getDbConn()
	{
		$config = include((dirname(__DIR__, 4) .  '/app/config.php'));

		$mysql = $config['mysql'];
		$dsn = $mysql['dsn'];
		$login = $mysql['login'];
		$password = $mysql['password'];

		try {
			$conn = new PDO($dsn, $login, $password);
			
			// setting the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			return $conn;
		}
		catch(PDOException $e)
		{
			echo $sql . "
			" . $e->getMessage();
		}
	}
}