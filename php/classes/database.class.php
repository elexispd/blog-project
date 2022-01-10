<?php 

class database{
	private $server = "localhost";
	private $username = "root";
	private $dbName = "blog";
	private $password = "";

	public function connect(){
		try {
			$dsn = "mysql:host=".$this->server.";dbname=".$this->dbName;
			$pdo = new PDO($dsn, $this->username, $this->password);
			$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
			return $pdo;
		} catch (Exception $e) {
			echo $e->getMessage();
		}

		
	}

}