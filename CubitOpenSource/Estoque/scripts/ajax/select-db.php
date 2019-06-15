<?php
include "../../../../config.php";
$util = new Util();

if ($util->checkMethod("GET")) {
	$a = $dbAdmin->findTable($_GET["table"])->getAll();

	// print_r($a); die;

	// $array[] =  array("name" => "" .$_GET["table"]);
	// $array[] =  array("name" => "" .$_GET["table"]);
	/*foreach ($a as $ar) {
		print_r($ar);
		$array[] = $ar;
	} */

	$array = array();
	$array[0] = array("name" => $_GET["table"]);

	foreach ($a as $key => $value) {
		$array[] = $value;
	}

	echo (! empty($array)) ? json_encode($array) : "";
} else {
	echo "";
}