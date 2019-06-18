<?php

$category = (! empty($_GET["category"])) ? $_GET["category"] : "";

$itemsPerPage = (! empty($_GET["s"])) ? intval($_GET["s"]) : 10;
$currentPage = (! empty($_GET["p"])) ? intval($_GET["p"]) : 1;

$allProducts = $this->dbAdmin->findTable("products")->getAll("", "", $category);
$numOfProducts = (count($allProducts) > 0) ? count($allProducts) : 1;
$products = $this->dbAdmin->findTable("products")->getAll($itemsPerPage, $currentPage, $category);

$maxPages = ($itemsPerPage > 0) ? (ceil($numOfProducts / $itemsPerPage)) : 1;

