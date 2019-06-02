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

	public function new()
	{

	}
}