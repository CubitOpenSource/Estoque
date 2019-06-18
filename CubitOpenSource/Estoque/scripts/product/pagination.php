<?php

$itemsPerPage = 1;
$currentPage = (! empty($_GET["p"])) ? intval($_GET["p"]) : 1;

$allProducts = $this->dbAdmin->findTable("products")->getAll();
$products = $this->dbAdmin->findTable("products")->getAll($itemsPerPage, $currentPage);

$maxPages = ($itemsPerPage > 0) ? (ceil(count($allProducts) / $itemsPerPage)) : 1;