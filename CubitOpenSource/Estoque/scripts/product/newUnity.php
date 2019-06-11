<?php
include "../../../../config.php";
$util = new Util();

if ($util->checkMethod("POST")) {
	if (! empty($_POST["save-unity"])) {		
		if (! empty($_POST["unity-name"])) {
			$a = array();
			$a["name"] = $_POST["unity-name"];
			$a["abbreviation"] = $_POST["unity-abbreviation"];

			$dbAdmin->findTable("unities")->insert($a);
			$util->redirect("products/" .$_POST["src-url"]);
		}
	} elseif (! empty($_POST["cancel-unity"])) {
		$util->redirect("products/" .$_POST["src-url"]);
	}
}