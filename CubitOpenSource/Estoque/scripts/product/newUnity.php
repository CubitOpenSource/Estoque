<?php
// include "../../../../config.php";
// $util = new Util();

if ($this->util->checkMethod("POST")) {
	// var_dump($_POST);

	if (! empty($_POST["save-unity"])) {
		$array = validation($this->util, $this->dbAdmin);
		if ($array != false) {
			$this->dbAdmin->findTable("unities")->insert($array);
			$this->util->closeWindow();
		}
	} else {
		$this->util->closeWindow();
	}
}

function validation($util, $dbAdmin)
{
	$res = true;
	$a = array();
	$a["name"] = $_POST["unity-name"];
	$a["abbreviation"] = $_POST["unity-abbreviation"];

	if (empty ($a["name"])) {
		$res = false;
		$util->setErrorMessage("name", "Digite o nome da Unidade");
	} else {
		$unities = $dbAdmin->findTable("unities")->getAll();
		
		foreach ($unities as $key => $u) {
			if ($u["name"] == $a["name"]) {
				$res = false;
				$util->setErrorMessage("name", "Já existe uma Unidade com este nome");
				break;
			}
		}
	}

	

	return $res ? $a : $res;
}