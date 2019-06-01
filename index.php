<?php
include __DIR__ ."/PackageLoader.php";

$loader = new PackageLoader\PackageLoader();
$loader->load(__DIR__ ."/CubitOpenSource/Estoque");

$pD = new CubitOpenSource\Database\ProdutoDAO();

# insert
/*$pD->insert(array(
	"id" => "1",
	"name" => "Biscoito Nikito 60g",
	"description" => "Nikito P"
));*/

# get
$array = $pD->get();

foreach ($array as $k => $produto) {
	echo "Id: " . $produto->getId() ."  ";
	echo "Nome: " .$produto->getName() ."  ";
	echo "Description: " .$produto->getDescription() ."  ";
}
echo "<hr>";