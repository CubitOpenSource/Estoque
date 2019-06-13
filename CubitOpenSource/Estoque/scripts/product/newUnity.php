<?php
include "../../../../config.php";
$util = new Util();

if ($util->checkMethod("POST")) {
	// var_dump($_POST);

	if (! empty($_POST["unity-name"])) {
		$a = array();
		$a["name"] = $_POST["unity-name"];
		$a["abbreviation"] = $_POST["unity-abbreviation"];

		$dbAdmin->findTable("unities")->insert($a);
		echo "success";
	}
}