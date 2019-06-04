<?php
use \PackageLoader\PackageLoader;
use \CubitOpenSource\Database\DB_Admin;

define("ENVIRONMENT", "dev");
// define("DEBUG", true);

switch (ENVIRONMENT) {
	case "dev":
		define("URL", "http://localhost/dev/cubit/estoque/");
		define("DB_NAME", "stock_db");
		define("DB_HOST", "127.0.0.1");
		define("DB_USER", "root");
		define("DB_PASS", "");
		define("DB_TYPE", "mysql");
		break;
	case "production":
		define("URL", "http://localhost/dev/cubit/estoque/");
		define("DB_NAME", "stock_db");
		define("DB_HOST", "127.0.0.1");
		define("DB_USER", "root");
		define("DB_PASS", "");
		define("DB_TYPE", "mysql");
		break;
	default:
		break;
}

include "PackageLoader.php";

$loader = new PackageLoader();
$loader->load(__DIR__ ."/CubitOpenSource/Estoque");

$dbAdmin = new DB_Admin();

function newClass(string $className, $params="")
{
	if (! class_exists($className)) {
		throw new Exception("Error loading class '" .$className ."'", 1);
	}
	/*try {
		$class = new $className($params);

	} catch(\Exception $e) {
		if (defined("DEBUG") && DEBUG === true) {
			echo "" .$e->getMessage() .$util->getErrorWithLine("config.php", 43);
		}
	}*/
	return new $className($params);
}