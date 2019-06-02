<?php

class HomeController extends Controller
{
	public function __construct()
	{
		parent::__construct("Home", "home", "default");
	}

	public function index()
	{
		$data = array();
		/*$l = $this->dbMan->getWidget("logo")->get();
		$footer = $this->dbMan->getFooterLayout()->get();

		$logo["txt"] = $l["txt"];
		$logo["size"] = $l["txt_size"];
		$logo["color"] = $l["txt_color"];
		$logo["color-hover"] = $l["txt_color_hover"];
		$logo["style"] = $l["txt_style"];
		$logo["img"] = $l["img"];
		$logo["url"] = $l["url"];
		$logo["display"] = $l["display"];
		$logo["position"] = $l["position"];

		$copyright = $footer["copyright"];

		$data["logo"] = $logo;
		$data["about"] = $this->dbMan->getWidget("aboutme")->get();
		$data["copyright"] = $copyright;*/
		
		$this->loadView($this->defaultView, $data);
	}
}