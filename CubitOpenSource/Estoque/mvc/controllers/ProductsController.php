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
		include "CubitOpenSource/Estoque/scripts/product/list.php";
		$categories = $this->dbAdmin->findTable("categories")->getAll($this->dbAdmin);

		$pages = array(
			array("name" => "list", "title" => "Lista de Produtos", "url" => URL ."products")
		);

		$columns = array(
			"Cód",
			"Produto",
			"Categoria",
			"Estoque",
			// "Preço de Venda",
			// "Data de Cadastro",
		);

		$data = array(
			"pages" => $pages,
			"currentPage" => "list",
			"columns" => $columns,
			"search" => $search,
			"products" => $products,
			"noCategoryProducts" => count($this->dbAdmin->findTable("products")->getAll($this->dbAdmin, "", "", -1)),
			"categories" => $categories,
			"category" => $category,
			"maxPages" => $maxPages,
			"currentPage" => $currentPage,
			"itemsPerPage" => $itemsPerPage
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
			$this->title = "Nova ";
			if ($entity == "unity") {
				$this->title .= "Unidade";
			} elseif ($entity == "brand") {
				$this->title .= "Marca";
			} elseif ($entity == "category") {
				$this->title .= "Categoria";
			} else {
				$this->util->redirect("404");
			}

			include "CubitOpenSource/Estoque/scripts/product/new-" .$entity .".php";
			$this->loadView("products/" .$entity ."-form");
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

		if (! empty($id)) {
			$t = (empty($_POST["description"])) ? $p["description"] : $_POST["description"];
			$pages[] = array("name" => "edit", "title" => $t, "url" => URL ."edit/" .$id);
		}
		else {
			$t = "Novo Produto";
			$pages[] = array("name" => "new", "title" => $t, "url" => URL ."new");
		}

		$data = array(
			"pages" => $pages,
			"id" => $id,
			"product" => $array,
			"unities" => $this->dbAdmin->findTable("unities")->getAll(),
			"brands" => $this->dbAdmin->findTable("brands")->getAll(),
			"categories" => $this->dbAdmin->findTable("categories")->getAll()
		);

		$this->title = end($pages)["title"];
		$this->loadView("products/product-form", $data);
	}
}