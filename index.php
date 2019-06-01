<?php
include __DIR__ ."/PackageLoader.php";

$loader = new PackageLoader\PackageLoader();
$loader->load(__DIR__ ."/CubitOpenSource/Estoque");


// $p = new CubitOpenSource\estoque\classes\Estoque();

// You call the package classes
$p = new CubitOpenSource\Estoque\Estoque();
$p->test();