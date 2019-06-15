<?php
include "../../../../config.php";
// TODO: select any data passed via POST or GET
$array = $dbAdmin->findTable("unities")->getAll();
echo (! empty($array)) ? json_encode($array) : "";