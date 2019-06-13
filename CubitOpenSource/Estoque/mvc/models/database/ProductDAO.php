<?php

namespace CubitOpenSource\Database;

use \IvanFilho\Database\Column;
use \IvanFilho\Database\DB_Table;
use \IvanFilho\Database\DB_Utils;
use \CubitOpenSource\Estoque\Produto;

/**
* Class: ProductDAO
* 
* Contains operations related to the Product DAO database table.
*
* @package      CubitOpenSource
* @subpackage   Database
* @author       CubitOpenSource <cubit.open.src@gmail.com>
*
* Created: Jun 1, 2019.
* Last Modified: Jun 2, 2019.
*/

class ProductDAO extends DB_Table
{
	public function __construct()
	{
		parent::__construct("products");
		$this->addColumn(new Column("id", INT, 0, false, "AUTO_INCREMENT", "PRIMARY KEY"));
		$this->addColumn(new Column("created_at", DATE));
		$this->addColumn(new Column("updated_at", DATE));
		$this->addColumn(new Column("active", INT));
		$this->addColumn(new Column("unity_id", INT));
		$this->addColumn(new Column("brand_id", INT));
		$this->addColumn(new Column("category_id", INT));
		$this->addColumn(new Column("description", TEXT));
		$this->addColumn(new Column("barcode", TEXT));
		$this->addColumn(new Column("location", VARCHAR, 200));
		$this->addColumn(new Column("image", TEXT));
		$this->addColumn(new Column("stock", INT));
		$this->addColumn(new Column("stock_min", INT));
		$this->addColumn(new Column("price_cost", DECIMAL));
		$this->addColumn(new Column("price_sell", DECIMAL));
		$this->addColumn(new Column("gain_percent", DECIMAL));
	}

	public function insert($array)
	{
		$array["created_at"] = date("Y-m-d");
		parent::insert($array);
	}

	public function update($array, $where = array())
	{
		$array["updated_at"] = date("Y-m-d");
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
}