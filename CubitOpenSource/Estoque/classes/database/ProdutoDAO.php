<?php

namespace CubitOpenSource\Database;

use \CubitOpenSource\Estoque\Produto;

class ProdutoDAO extends Database
{
	public function __construct()
	{
		parent::__construct();
	}

	public function get($fields = array(), $where = array())
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

	public function insert($fields = array())
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
	}
}