<?php

class Error404Controller extends Controller
{
	public function __construct()
	{
		parent::__construct("Page Not Found", "404", "default");
	}

	public function index()
	{
		$data = array();		
		$this->loadView($this->defaultView, $data);
	}
}