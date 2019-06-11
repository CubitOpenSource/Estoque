<?php

namespace CubitOpenSource\Database;

/**
* Class: DB_Admin
* 
* Holds all database table objects used in this project.
*
* @package      CubitOpenSource
* @subpackage   Database
* @author       CubitOpenSource <cubit.open.src@gmail.com>
*
* Created: Jun 1, 2019.
* Last Modified: Jun 1, 2019.
*/

class DB_Admin
{
	public function __construct()
	{
		$this->tables[] = new ProdutoDAO();
		$this->tables[] = new UnityDAO();

		$this->createTables();
	}

	private function createTables()
	{
		foreach ($this->tables as $table) {
			$table->create();
		}
	}

	private function dropTables()
	{
		foreach ($this->tables as $table) {
			$table->drop();
		}
	}

	public function findTable($name)
	{
		$table = false;
		foreach ($this->tables as $t) {
		    if ($t->getName() === $name) {
		        $table = $t;
		        break;
		    }
		}
		return $table;
	}
}