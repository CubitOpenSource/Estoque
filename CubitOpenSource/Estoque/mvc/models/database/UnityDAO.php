<?php

namespace CubitOpenSource\Database;

use \IvanFilho\Database\Column;
use \IvanFilho\Database\DB_Table;
use \IvanFilho\Database\DB_Utils;

/**
* Class: UnityDAO
* 
* Contains operations related to the Unity DAO database table.
*
* @package      CubitOpenSource
* @subpackage   Database
* @author       CubitOpenSource <cubit.open.src@gmail.com>
*
* Created: Jun 10, 2019.
* Last Modified: Jun 11, 2019.
*/

class UnityDAO extends DB_Table
{
	public function __construct()
	{
		parent::__construct("unities");
		$this->addColumn(new Column("id", INT, 0, false, "AUTO_INCREMENT", "PRIMARY KEY"));
		$this->addColumn(new Column("name", TEXT));
		$this->addColumn(new Column("abbreviation", VARCHAR, 5));

		$this->listeners = array();
	}

	public function insert($array)
	{
		parent::insert($array);
		$this->notify();
	}

	public function update($array, $where = array())
	{
		$where[] = DB_Utils::createCondition($this, "id", $array["id"]);
		parent::update($array, $where);
	}

	public function delete($id)
	{
		$where[] = DB_Utils::createCondition($this, "id", $id);
		parent::delete($where);
	}

	public function get($id, $asList = false)
	{
		$where[] = DB_Utils::createCondition($this, "id", $id);
		return parent::selectOne(array(), $where, $asList);
	}

	public function getAll()
	{
		return parent::selectAll(array(), array(), true);
	}

	public function addListener(Listener $l) {
		$this->listeners[] = $l;
	}

	public function removeListener(Listener $listener) {
		foreach ($this->listeners as $key => $l) {
			if ($l == $listener) {
				unset($this->listeners[$key]);
				break;
			}
		}
	}

	public function notify()
	{
		foreach ($this->listeners as $l) {
			$l->update();
		}
	}
}