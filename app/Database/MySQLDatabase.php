<?php
namespace App\Database;

class MySQLDatabase
{
	private $host;
	private $username;
	private $password;
	private $database;
	public $connection;

	public function __construct($host, $username, $password, $database)
	{
		$this->host = $host;
		$this->username = $username;
		$this->password = $password;
		$this->database = $database;
	}

	public function connect()
	{
		$this->connection = mysqli_connect($this->host, $this->username, $this->password, $this->database);

		if (mysqli_connect_errno()) {
			die("Database connection failed: " . mysqli_connect_error());
		}
	}

	public function close()
	{
		if ($this->connection) {
			mysqli_close($this->connection);
		}
	}

	public function query($sql)
	{
		$result = mysqli_query($this->connection, $sql);

		if (!$result) {
			die("Database query failed: " . mysqli_error($this->connection));
		}

		return $result;
	}

	public function escape($datos)
	{
		$datosPreparados = array();
		foreach ($datos as $key => $value) {
			$value = trim($value);
			$value = stripslashes($value);
			$value = htmlspecialchars($value);
			$value = utf8_decode($value);
			$value = mysqli_real_escape_string($this->connection, $value);
			$datosPreparados[$key] = $this->connection->real_escape_string($value);
		}
		return $datosPreparados;
	}


}

?>