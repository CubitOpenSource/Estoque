<?php
if ($this->util->checkMethod("POST")) {
	if (! empty($_POST["save"])) {
		$res = validation($array, $this->util, $this->dbAdmin);

		if ($res !== false) {
			$array = $res;
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

function validation($product, $util, $dbAdmin)
{
	$res = true;
	$supportedTypes = array("image/jpeg", "image/png");

	if (empty($product["description"])) {
		$res = false;
		$util->setErrorMessage("description", "Digite a descrição do produto.");
	} else {
		if ($_POST["operation"] == 0) {
			# Check product with same description
			$data = $dbAdmin->findTable("products")->getAll();
			foreach ($data as $key => $d) {
				if ($d["description"] == $product["description"]) {
					$res = false;
					$util->setErrorMessage("description", "Já existe um Produto com a mesma descrição.");
					break;
				}
			}
		}
	}

	if (empty($product["price_cost"]) || $product["price_cost"] <= 0) {
		$res = false;
		$util->setErrorMessage("price-cost", "Digite o preço de custo do produto.");
	}

	if (empty($product["price_sell"]) || $product["price_sell"] <= 0) {
		$res = false;
		$util->setErrorMessage("price-sell", "Digite o preço de venda do produto.");
	}

	# Replace commas (,) by dots (.) in prices
	$product["price_cost"] = str_replace(",", ".", $product["price_cost"]);
	$product["price_sell"] = str_replace(",", ".", $product["price_sell"]);

	if ($res) {
		$img = $_FILES["image"];

		if (! empty($img)) {
			$type = $img["type"];
			if (in_array($type, $supportedTypes)) {
				$tmpName = md5(time() .rand(0, 9999)) .".jpg";
				$imagePath = "assets/img/products/" .$tmpName;

				if (! empty($product["image"]))
					deleteImage($product["image"]);
				move_uploaded_file($img["tmp_name"], $imagePath);

				# Resize and save image
				saveResizedImage($type, $imagePath);
				$product["image"] = $tmpName;
			}
		}	
	}

	return ($res) ? $product : $res;
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