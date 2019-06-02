<?php
define("DEFAULT_CONTROLLER", "Home");
define("DEFAULT_CONTROLLER_NOT_FOUND", "Error404");
define("DEFAULT_ACTION", "index");
define("DEFAULT_PARAMS", array(""));

class Core
{
	public function __construct($localDebugging=false)
	{
		$this->localDebugging = $localDebugging;
		$this->suffix = "Controller";
	}

	public function start()
	{
		$debug = (defined("DEBUG") && DEBUG === true && $this->localDebugging) ? true : false;
		$util = new Util();
		$url = "/";
		$url .= (! empty($_GET["url"])) ? $_GET["url"] : "";

		if ($debug) {
			echo "<b>Debugging is Activated</b><br>";
		}

		if ($debug) {
			echo "URL: " .$url ."<br><hr>";
		}

		# Get controller, action, and params from URL

		if ($url !== "/") {
			$url = explode("/", $url);

			# Removes first index
			array_shift($url);

			# Get controller
			$controllerName = $this->getControllerNameFromUrl($url);

			array_shift($url);
			# Get Action
			$actionName = $this->getActionNameFromUrl($url);

			array_shift($url);
			# Get Params
			$params = $this->getParametersFromUrl($url);
		} else {
			$controllerName = DEFAULT_CONTROLLER;
			$actionName = DEFAULT_ACTION;
			$params = DEFAULT_PARAMS;
		}

		if (strcasecmp($controllerName, "cpanel") == 0) {
			$controllerName = "CPanel";
		} elseif (strcasecmp($controllerName, "") == 0) {
		
		}

		if ($debug) {
			echo "Controller: " .$controllerName ."<br>";
			echo (! empty($actionName)) ? "Action: " .$actionName ."<br>" : "<br>";
			echo "Parameters: ";
			print_r($params) ."<br>";
			echo "<br><hr>";
		}

		# Instantiate Controller
		try {
			$controller = newClass($controllerName .$this->suffix);
		} catch(Exception $e) {
			if ($debug) {
				echo "Controller \"<b>" .$controllerName ."</b>\" not Found" .$util->getErrorWithLine("core/Core.php", 67);
				die;
			}
			$controller = newClass(DEFAULT_CONTROLLER_NOT_FOUND .$this->suffix);
		}
		
		if (! method_exists($controller, $actionName)) {
			$actionName = DEFAULT_ACTION;
		}

		# Call action
		call_user_func_array(array($controller, $actionName), $params);
	}

	private function getControllerNameFromUrl(array $url)
	{
		# TODO: Allow any file extension
		#$c = (strpos($url[0], ".php") !== false) ? substr($url[0], 0, - strlen(".php")) : $url[0];
		
		# Not allowing .php extensions. Todo: do not allow any using regex.
		if (! strpos($url[0], ".php")) {
			$c = ucfirst($url[0]);
		} else {
			return false;
		}

		return $c;
		// return ($c != DEFAULT_CONTROLLER_NOT_FOUND) ? $c : false;
	}

	private function getActionNameFromUrl(array $url)
	{
		if (isset($url[0]) && !empty($url[0])) {
			$act = (strpos($url[0], ".php") !== false) ? substr($url[0], 0, - strlen(".php")) : $url[0];
			return (isset($act) && ! empty($act)) ? $act : DEFAULT_ACTION;
		} else {
			return DEFAULT_ACTION;
		}
	}

	private function getParametersFromUrl(array $url)
	{
		return (count($url) > 0) ? $url : DEFAULT_PARAMS;
	}
}