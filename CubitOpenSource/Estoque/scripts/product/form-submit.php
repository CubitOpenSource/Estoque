<?php
if ($this->util->checkMethod("POST")) {
	if (! empty($_POST["save"])) {
		$array = validation($array, $this->util, $this->dbAdmin);
		// var_dump($array);
		// echo "<br>Operation: " .$_POST["operation"];

		if ($array !== false) {
			if ($_POST["operation"] == 0) {
				$this->dbAdmin->findTable("products")->insert($array);
			} elseif ($_POST["operation"] == 1) {
				$this->dbAdmin->findTable("products")->update($array);
			}
			$this->util->redirect("products");
		}
	} elseif (! empty($_POST["cancel"])) {
		$this->util->redirect("products");
	}
}

function validation($array, $util, $dbAdmin)
{
	$res = true;
	$supportedTypes = array("image/jpeg", "image/png");

	if (empty($array["description"])) {
		$res = false;
		$util->setErrorMessage("description", "Digite a descrição do produto.");
	}

	if (empty($array["price_cost"])) {
		$res = false;
		$util->setErrorMessage("price-cost", "Digite o preço de custo do produto.");
	}

	if (empty($array["price_sell"])) {
		$res = false;
		$util->setErrorMessage("price-sell", "Digite o preço de venda do produto.");
	}

	// TODO: check product with the same description

	// Replace commas (,) by dots (.) in prices
	$array["price_cost"] = str_replace(",", ".", $array["price_cost"]);
	$array["price_sell"] = str_replace(",", ".", $array["price_sell"]);

	if ($res) {
		$img = $_FILES["image"];

		if (! empty($img)) {
			$type = $img["type"];
			if (in_array($type, $supportedTypes)) {
				$tmpName = md5(time() .rand(0, 9999)) .".jpg";
				$imagePath = "assets/img/products/" .$tmpName;

				if (! empty($array["image"]))
					deleteImage($array["image"]);
				move_uploaded_file($img["tmp_name"], $imagePath);

				# resize and save image
				saveResizedImage($type, $imagePath);
				$array["image"] = $tmpName;
			}
		}	
	}

	return ($res) ? $array : $res;
}

function saveResizedImage($type, $imagePath)
{
	list($srcWidth, $srcHeight) = getimagesize($imagePath);
	$ratio = $srcWidth / $srcHeight;
	$width = 120;
	$height = 120;

	if (($width/$height) > $ratio) {
		$width = $height * $ratio;
	}
	else {
		$height = $width / $ratio;
	}

	$img = imagecreatetruecolor($width, $height);
	
	
	switch ($type) {
		case "image/jpeg":
			$src = imagecreatefromjpeg($imagePath);
			break;
		case "image/png":
			$src = imagecreatefrompng($imagePath);
			break;
		default:
			$src = "";
			break;
	}

	imagecopyresampled($img, $src, 0, 0, 0, 0, $width, $height, $srcWidth, $srcHeight);
	imagejpeg($img, $imagePath, 80);
}

function deleteImage($filename)
{
	$filename = "assets/img/products/" .$filename;

	if (file_exists($filename)) {
		unlink($filename);
	} else {
		// echo 'Could not delete '.$filename.', file does not exist';
	}
}