<?php
// include "../../../../config.php";
// $util = new Util();

if ($this->util->checkMethod("POST")) {
	// var_dump($_POST);

	if (! empty($_POST["unity-name"])) {
		$a = array();
		$a["name"] = $_POST["unity-name"];
		$a["abbreviation"] = $_POST["unity-abbreviation"];

		$this->dbAdmin->findTable("unities")->insert($a);
		echo "success";
	}
}