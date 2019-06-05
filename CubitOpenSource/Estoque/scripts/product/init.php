<?php
$p = (! empty($id)) ? $this->dbAdmin->findTable("products")->get($id) : "";
$array = array();

$array["id"] = isset($_POST["id"]) ? $_POST["id"] : ((! empty($p["id"]) ? $p["id"] : ""));
$array["active"] = isset($_POST["active"]) ? $_POST["active"] : (! empty($p["active"]) ? $p["active"] : "");
$array["barcode"] = isset($_POST["barcode"]) ? $_POST["barcode"] : (! empty($p["barcode"]) ? $p["barcode"] : "");
$array["unity_id"] = isset($_POST["unity"]) ? $_POST["unity"] : (! empty($p["unity_id"]) ? $p["unity_id"] : "");
$array["description"] = isset($_POST["description"]) ? $_POST["description"] : (! empty($p["description"]) ? $p["description"] : "");
$array["location"] = isset($_POST["location"]) ? $_POST["location"] : (! empty($p["location"]) ? $p["location"] : "");
$array["brand_id"] = isset($_POST["brand"]) ? $_POST["brand"] : (! empty($p["brand_id"]) ? $p["brand_id"] : "");
$array["category_id"] = isset($_POST["category"]) ? $_POST["category"] : (! empty($p["category_id"]) ? $p["category_id"] : "");
$array["gain_percent"] = isset($_POST["gain-percent"]) ? $_POST["gain-percent"] : (! empty($p["gain_percent"]) ? $p["gain_percent"] : "");
$array["price_cost"] = isset($_POST["price-cost"]) ? $_POST["price-cost"] : (! empty($p["price_cost"]) ? $p["price_cost"] : "");
$array["price_sell"] = isset($_POST["price-sell"]) ? $_POST["price-sell"] : (! empty($p["price_sell"]) ? $p["price_sell"] : "");
$array["stock"] = isset($_POST["stock"]) ? $_POST["stock"] : (! empty($p["stock"]) ? $p["stock"] : "");
$array["stock_min"] = isset($_POST["stock-min"]) ? $_POST["stock-min"] : (! empty($p["stock_min"]) ? $p["stock_min"] : "");
$array["image"] = isset($_POST["image"]) ? $_POST["image"] : (! empty($p["image"]) ? $p["image"] : "");
$array["created_at"] = (! empty($p["created_at"])) ? $p["created_at"] : "";
$array["updated_at"] = (! empty($p["updated_at"])) ? $p["updated_at"] : "";

# Get product ID
$allProducts = $this->dbAdmin->findTable("products")->getAll();
$lastProduct = end($allProducts);
$lastId = (isset($lastProduct["id"])) ? $lastProduct["id"] : 0;

$array["id"] = (! empty($array["id"])) ? $array["id"] : ((! empty($lastId)) ? ($lastId + 1) : 1);