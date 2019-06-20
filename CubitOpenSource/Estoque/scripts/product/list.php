<?php

$search = (! empty($_GET["search"])) ? $_GET["search"] : "";


$category = (! empty($_GET["category"])) ? $_GET["category"] : "";
$itemsPerPage = (! empty($_GET["items"])) ? intval($_GET["items"]) : 10;
$currentPage = (! empty($_GET["page"])) ? intval($_GET["page"]) : 1;

$allProducts = $this->dbAdmin->findTable("products")->getAll("", "", $category);
$numOfProducts = (count($allProducts) > 0) ? count($allProducts) : 1;



if (! empty($search)) {
	$products = $this->dbAdmin->findTable("products")->getAll("", "", "", $search);
} else {
	$products = $this->dbAdmin->findTable("products")->getAll($itemsPerPage, $currentPage, $category);	
}

$maxPages = ($itemsPerPage > 0) ? (ceil($numOfProducts / $itemsPerPage)) : 1;

