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
		$pages = array(
			array("name" => "list", "title" => "Lista de Produtos", "url" => URL ."products")
		);

		$columns = array(
			"Cód",
			"Produto",
			"Categoria",
			"Estoque",
			"Preço de Venda",
			"Data de Cadastro",
		);

		$data = array(
			"pages" => $pages,
			"currentPage" => "list",
			"columns" => $columns,
			"products" => $this->dbAdmin->findTable("products")->getAll()
		);

		$this->title = end($pages)["title"];
		$this->loadView($this->defaultView, $data);
	}

	public function view($id)
	{
		# TODO...
	}

	public function new($entity="")
	{
		if (! empty($entity)) {
			if ($entity == "unity") {
				// $this->util->redirect("CubitOpenSource/Estoque/scripts/product/newUnity.php");
				// include "CubitOpenSource/Estoque/scripts/product/newUnity.php";
				$this->loadView("products/unity");
			} elseif ($entity == "brand") {
				#
			} elseif ($entity == "category") {
				#
			} else {
				$this->util->redirect("404");
			}
		} else {
			$this->saveEdit();
			
		}
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

		$pages = array(
			array("name" => "list", "title" => "Lista de Produtos", "url" => URL ."products")
		);

		if (! empty($id))
			$pages[] = array("name" => "edit", "title" => $array["description"], "url" => URL ."edit/" .$id);
		else
			$pages[] = array("name" => "new", "title" => "Novo Produto", "url" => URL ."new");

		$data = array(
			"pages" => $pages,
			"id" => $id,
			"product" => $array
		);

		$this->title = end($pages)["title"];
		$this->loadView("products/product-form", $data);
	}
}