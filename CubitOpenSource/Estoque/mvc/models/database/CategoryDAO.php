<?php

namespace CubitOpenSource\Database;

use \IvanFilho\Database\Column;
use \IvanFilho\Database\DB_Table;
use \IvanFilho\Database\DB_Utils;

/**
* Class: CategoryDAO
* 
* Contains operations related to the Category DAO database table.
*
* @package      CubitOpenSource
* @subpackage   Database
* @author       CubitOpenSource <cubit.open.src@gmail.com>
*
* Created: Jun 13, 2019.
* Last Modified: Jun 13, 2019.
*/

class CategoryDAO extends DB_Table
{
	public function __construct()
	{
		parent::__construct("categories");
		$this->addColumn(new Column("id", INT, 0, false, "AUTO_INCREMENT", "PRIMARY KEY"));
		$this->addColumn(new Column("name", TEXT));
	}

	public function insert($array)
	{
		parent::insert($array);
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

	public function getAll($db="")
	{
		$additional = array();

		if (! empty($db)) {
			$productTable = $db->findTable("products");

			$table1 = array("name" => "", "select" => array(), "where"  => array(), "as" => "", "limit" => "");

			$table1["name"] = $productTable->getName();
			$table1["select"][] = DB_Utils::createSelection($productTable, "category_id");
			$table1["where"][] = DB_Utils::createCondition($productTable, "category_id", "id");
			$table1["as"] = "products";
			$table1["limit"] = 2;

			$additional[] = $table1;
		}

		return parent::selectWithAdditionalColumn(array(), array(), "", $additional, array(), true);
		// return parent::selectAll(array(), array(), true);
	}
}