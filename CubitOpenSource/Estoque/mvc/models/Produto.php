<?php

namespace CubitOpenSource\Estoque;

class Produto
{
	private $id;
	private $name;
	private $description;

	public function __construct($array)
	{
		$this->id = (isset($array["id"])) ? $array["id"] : "";
		$this->name = (isset($array["name"])) ? $array["name"] : "";
		$this->description = (isset($array["description"])) ? $array["description"] : "";
	}

	public function getId() { return $this->id; }
	public function getName() { return $this->name; }
	public function getDescription() { return $this->description; }
}