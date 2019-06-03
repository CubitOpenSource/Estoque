<?php

class ProductController extends Controller
{
	public function __construct()
	{
		parent::__construct("Product", "product-list", "default");
	}

	public function index()
	{
		$data = array();
		$this->loadView($this->defaultView, $data);
	}

	public function list()
	{
		$columns = array(
			"Código",
			"Descrição",
			"Preço de Venda",
			"Data de Cadastro",
		);

		$data = array(
			"columns" => $columns,
			"products" => $this->dbAdmin->findTable("products")->getAll()
		);
		$this->loadView($this->defaultView, $data);
	}

	public function new()
	{
		include "./CubitOpenSource/Estoque/scripts/product/init.php";
		include "./CubitOpenSource/Estoque/scripts/product/form-submit.php";

		$data = array(
			"product" => $array
		);

		$this->loadView("product-form", $data);
	}
}