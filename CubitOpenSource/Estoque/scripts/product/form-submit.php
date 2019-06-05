<?php
if ($this->util->checkMethod("POST")) {
	$array = validation($array, $this->util, $this->dbAdmin);
	if ($array !== false) {
		$this->dbAdmin->findTable("products")->insert($array);
		$this->util->redirect("product/list");
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

	if ($res) {
		$img = $_FILES["image"];

		if (! empty($img)) {
			$type = $img["type"];
			if (in_array($type, $supportedTypes)) {
				$tmpName = md5(time() .rand(0, 9999)) .".jpg";
				$imagePath = "assets/img/products/" .$tmpName;
				move_uploaded_file($img["tmp_name"], $imagePath);

				# resize and save image
				saveResizedImage($type, $imagePath);
				$array["image"] = $tmpName;
			}
		} else {
			// TODO...
			// get image url/name from database so it won't be changed
			var_dump($array["image"]); die;
		}		
	}

	return ($res) ? $array : $res;
}

function saveResizedImage($type, $imagePath)
{
	list($srcWidth, $srcHeight) = getimagesize($imagePath);
	$ratio = $srcWidth / $srcHeight;
	$width = 500;
	$height = 500;

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