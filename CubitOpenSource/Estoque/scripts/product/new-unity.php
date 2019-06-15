<?php
if ($this->util->checkMethod("POST")) {
	// var_dump($_POST);

	if (! empty($_POST["save"])) {
		$array = validation($this->util, $this->dbAdmin);
		if ($array != false) {
			$this->dbAdmin->findTable("data")->insert($array);
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
	$a["name"] = $_POST["name"];
	$a["abbreviation"] = $_POST["abbreviation"];

	if (empty ($a["name"])) {
		$res = false;
		$util->setErrorMessage("name", "Digite o nome da Unidade.");
	} else {
		$data = $dbAdmin->findTable("data")->getAll();
		
		foreach ($data as $key => $d) {
			if ($d["name"] == $a["name"]) {
				$res = false;
				$util->setErrorMessage("name", "Já existe uma Unidade com este nome.");
				break;
			}
		}
	}

	return $res ? $a : $res;
}