<?php

namespace CubitOpenSource\Database;

use \PDO;

class Database
{
	protected $db;

	public function __construct()
	{
		try {
			$this->db = new PDO("mysql:dbname=estoque_db;host=localhost", "root", "");
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e) {
			die($e->getMessage());
		}
	}
}