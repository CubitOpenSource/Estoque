<?php

class ProductsController extends Controller
{
	public function __construct()
	{
		parent::__construct("Product", "products/product-list", "default");
	}

	public function index()
	{
		$this->list();
	}

	public function list()
	{
		$columns = array(
			"Cód",
			"Produto",
			"Categoria",
			"Estoque",
			"Preço de Venda",
			"Data de Cadastro",
		);

		$data = array(
			"columns" => $columns,
			"products" => $this->dbAdmin->findTable("products")->getAll()
		);
		$this->loadView($this->defaultView, $data);
	}

	public function view($id)
	{
		# TODO...
	}

	public function new()
	{
		$this->saveEdit();
	}

	public function edit($id)
	{
		$this->saveEdit($id);
	}

	public function delete($id)
	{
		include "./CubitOpenSource/Estoque/scripts/product/delete.php";
	}

	private function saveEdit($id="")
	{
		include "./CubitOpenSource/Estoque/scripts/product/init.php";
		include "./CubitOpenSource/Estoque/scripts/product/form-submit.php";

		$data = array(
			"id" => $id,
			"product" => $array
		);

		$this->loadView("products/product-form", $data);
	}
}