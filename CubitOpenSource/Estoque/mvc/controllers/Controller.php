<?php

abstract class Controller
{
	public function __construct($title, $defaultView, $defaultTemplate)
	{
		global $dbAdmin;
		$this->dbAdmin = $dbAdmin;
		$this->util = new Util();
		$this->title = $title;
		$this->defaultView = $defaultView;
		$this->defaultTemplate = $defaultTemplate;
	}
	
	public abstract function index();

	protected function loadView($view="", $data=array(), $template="")
	{
		$view = (! empty($view)) ? $view : $this->defaultView;
		$template = (! empty($template)) ? $template : $this->defaultTemplate;

		require "./CubitOpenSource/Estoque/mvc/views/templates/" .$template ."/" .$template .".php";
	}

	private function loadViewIntoTemplate($view, $data=array())
	{
		$subpath = "./CubitOpenSource/Estoque/mvc/views/";
		$this->requireView($subpath, $view, $data);
	}

	private function loadViewPart($view, $data=array())
	{
		$subpath = "./mvc/views/parts/";
		$this->requireView($subpath, $view, $data);
	}

	private function requireView($subpath, $view, $data=array())
	{
		$debug = (defined("DEBUG") && DEBUG === true) ? true : false;

		if (! empty($data))	extract($data);
		$file = $subpath .$view .".php";

		if (file_exists($file)) {
			require $file;
		} else {
			if ($debug) {
				echo "View not found";
			} else {
				$this->util->redirect("404");
			}
		}
	}
}