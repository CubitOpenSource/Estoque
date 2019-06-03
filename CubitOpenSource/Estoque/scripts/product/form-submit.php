<?php
if ($this->util->checkMethod("POST")) {
	if (validation($array, $this->util)) {
		$this->dbAdmin->findTable("products")->insert($array);
		$this->util->redirect("product/list");
	}
}

function validation($array, $util)
{
	$res = true;

	if (empty($array["description"])) {
		$res = false;
		$util->setErrorMessage("description", "Digite a descrição do produto.");
	}

	// TODO: check product with the same description

	if ($res) {
		// ... image processing
	}

	return $res;
}