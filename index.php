<?php
include __DIR__ ."/PackageLoader.php";

$loader = new PackageLoader\PackageLoader();
$loader->load(__DIR__ ."/CubitOpenSource/estoque");


$p = new CubitOpenSource\estoque\Estoque();
