<?php
session_start();
define("URL", "http://localhost/dev/cubit/Estoque/CubitOpenSource/Estoque/");

use \PackageLoader\PackageLoader;
use \CubitOpenSource\Database\DB_Admin;

include "./PackageLoader.php";

$loader = new PackageLoader();
$loader->load(__DIR__ ."/CubitOpenSource/Estoque");

$dbAdmin = new DB_Admin();

/*$dbAdmin->findTable("products")->insert(array(
	"name" => "Produto 3",
	"description" => "No description"
));*/

/*$dbAdmin->findTable("products")->update(array(
	"id" => "4",
	"name" => "Produto 0004",
	"description" => "chocolate"
));*/

// $dbAdmin->findTable("products")->delete(2);
// var_dump($dbAdmin->findTable("products")->getAll());