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

	if (empty($array["price_cost"])) {
		$res = false;
		$util->setErrorMessage("price-cost", "Digite o preço de custo do produto.");
	}

	if (empty($array["price_sell"])) {
		$res = false;
		$util->setErrorMessage("price-sell", "Digite o preço de venda do produto.");
	}

	// TODO: check product with the same description

	if ($res) {
		// ... image processing
	}

	return $res;
}