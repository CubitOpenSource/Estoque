<?php
class Util
{
	public function __construct()
	{
		$this->errorMsg = array();
	}

	public function closeWindow()
	{
		?>
		<script>
			window.close();
		</script>
		<?php
		exit;
	}
	
	public function redirect($relPath)
	{
		?>
		<div id="data" data-url="<?php echo URL .$relPath; ?>"></div>
		<script>
			var url = document.getElementById("data").getAttribute("data-url");
			window.location.href = url;
		</script>
		<?php
		exit();
	}

	public function getSupportedImageTypes()
	{
		return array("image/jpeg", "image/png", "image/gif");
	}

	public function checkMethod($method)
	{
		return $_SERVER["REQUEST_METHOD"] === $method; 
	}

	public function formatHTML($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);

		return (! empty($data)) ? $data : "";
	}

	public function getErrorWithLine(string $src, $line)
	{
		return " in \"" .$src ."\" <b>line " .$line ."</b>.<hr>";
	}

	public function getErrorMessageArray()
	{
		return $this->errorMsg;
	}

	public function issetErrorMessage($index)
	{
		return (! empty($this->errorMsg[$index])) ? true : false;
	}

	public function getErrorMessage($index, $echo=false)
	{
		if ($echo)
			echo (isset($this->errorMsg[$index])) ? $this->errorMsg[$index] : "";
		else
			return (isset($this->errorMsg[$index])) ? $this->errorMsg[$index] : "";
	}

	public function setErrorMessage($index, $message)
	{
		$this->errorMsg[$index] = $message;
	}

	public function getArrayFromIni($fileName)
	{
		$file = "./configuration/" .$fileName .".ini";
		
		if (file_exists($file)) {
			return parse_ini_file($file);
		}
		return false;
	}

	public function getValueFromIni($array, $index, $return=false)
	{
		$t = $index;
		if (isset($array[$index])) {
			$t = $array[$index];
		}

		if ($return) {
			return $t;
		} else {
			echo $t;
		}
	}
}