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
* Last Modified: Jun 1, 2019.
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

	public function get($id) {}

	public function getAll() {}

	/*public function getB($fields = array(), $where = array())
	{
		$produtos = array();
		$valores = array();
		if (count($fields) == 0) {
			$fields = array("*");
		}
		$sql = "SELECT " .implode(",", $fields) ." FROM `produtos`";
		if (count($where) > 0) {
			$tabelas = array_keys($where);
			$valores = array_values($where);
			$comp = array();
			foreach ($tabelas as $tabela) {
				$comp[] = $tabela ." = ?";
			}
			$sql .= implode(" AND ", $comp);
		}
		$sql = $this->db->prepare($sql);
		$sql->execute($valores);
		if ($sql->rowCount() > 0) {
			foreach ($sql->fetchAll() as $item) {
				$produtos[] = new Produto($item);
			}
		}
		return $produtos;
	}
	public function insertB($fields = array())
	{
		if (count($fields) > 0) {
			$pseudoValues = array();
			for ($i = 0; $i < count($fields); $i++) {
				$pseudoValues[] = "?";
			}
			$sql = "INSERT INTO `produtos` (" .implode(",", array_keys($fields)).") VALUES (" .implode(",", $pseudoValues) .")";
			$sql = $this->db->prepare($sql);
			$sql->execute(array_values($fields));
		}
	}*/
}