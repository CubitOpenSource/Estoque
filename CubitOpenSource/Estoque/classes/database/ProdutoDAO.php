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

class ProdutoDAO extends DB_Table
{
	public function __construct()
	{
		parent::__construct("products");
		$this->addColumn(new Column("id", INT, 0, false, "AUTO_INCREMENT", "PRIMARY KEY"));
		$this->addColumn(new Column("name", VARCHAR, 100));
		$this->addColumn(new Column("description", VARCHAR, 200));
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

	public function get($id)
	{
		$where[] = DB_Utils::createCondition($this, "id", $id);
		return parent::selectOne(array(), $where);
	}

	public function getAll()
	{
		return parent::selectAll();
	}
}