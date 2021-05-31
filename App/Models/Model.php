<?php

namespace App\Models;

use PDO;
use PDOException;

class Model
{
	protected $conn;

	public function __construct()
	{
		$this->connect();
	}

	private function connect(): void
    {
		if (!$this->conn) {
			try {
				$this->conn = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);

                return;
			} catch (PDOException $e) {
				die($e->getMessage());
			}
		}
    }
}
