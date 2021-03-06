<script src="<?= URL ?>assets/js/util.js"></script>
<link rel="stylesheet" href="<?= URL ?>CubitOpenSource/Estoque/mvc/views/products/css/form.css">

<?php $this->loadViewPart("navigation", array("pages" => $pages)); ?>

<script>
	var callback = function updateDataFromDatabase(data) {
		// console.log(data);

		if (data != "") {
			data = JSON.parse(data);
			console.log(data);

			var name = data[0]["name"];
			var selects = document.getElementsByTagName("select");
			var selectIndex = -1;

			for (var i = 0; i < selects.length; i++) {
				if (selects[i].name == name) {
					selectIndex = i;
					break;
				}
			}
			if (selectIndex == -1) { return; }

			var select = selects[selectIndex];
			var selectedIndex = select.options.selectedIndex;

			for (var i = 1; i < data.length; i++) {
				var dataId = data[i]["id"];
				var dataName = data[i]["name"];
				if (name == "unities") {
					dataName += (data[i]["abbreviation"] != "") ? " (" + data[i]["abbreviation"] + ")" : "";
				}

				var o = document.createElement("option");
				o.value = dataId;
				o.innerHTML = dataName;
				if (i == selectedIndex) { o.selected = "true"; }

				select.options[i] = o;
			}
		}
	};

	function updateUnities() {
		var url = "<?= URL ."CubitOpenSource/Estoque/scripts/ajax/select-db.php" ?>";
		url += "?table=unities";
		ajax(url, callback);
	}

	function updateBrands() {
		var url = "<?= URL ."CubitOpenSource/Estoque/scripts/ajax/select-db.php" ?>";
		url += "?table=brands";
		ajax(url, callback);
	}

	function updateCategories() {
		var url = "<?= URL ."CubitOpenSource/Estoque/scripts/ajax/select-db.php" ?>";
		url += "?table=categories";
		ajax(url, callback);
	}

	window.onload = function() {
		var options = document.getElementsByClassName("btn-option");
		for (var i = 0; i < options.length; i++) {
			options[i].addEventListener("click", function(e) {
				var url = this.href;
				var title = "";
				e.preventDefault();
				openWindow(url, title);
			}, 1);
		}

		setInterval(updateUnities, 1000);
		setInterval(updateBrands, 1000);
		setInterval(updateCategories, 1000);
	}
</script>

<section class="main-container">
	<h1><?= $this->title; ?></h1>

	<form class="main-grid" name="product" method="POST" enctype="multipart/form-data">
		<input type="hidden" name="operation" value="<?= (empty($id)) ? 0 : 1 ?>">

		<fieldset class="general-field">
			<legend>Geral</legend>

			<div class="general-wrapper">
				<div class="input-wrapper product-picture">
					<label style="text-align: center;">Imagem do Produto</label>

					<div class="image-preview" style="display: flex; align-items: center; justify-content: center; width: 120px; height: 120px; margin: auto; text-align: center; border: 1px solid #ccc; overflow: hidden;">
						<img id="image-preview" src="<?= URL ."assets/img/" ?><?= (! empty($product["image"])) ? "products/" .$product["image"] : "no-picture.svg" ?>" style="max-width: 100%; max-height: 100%;">
					</div>
					
					<input id="file-input" class="input-file" type="file" name="image" onchange="updatePreviewImage.call(this)">

					<label for="file-input" class="btn btn-default" style="width: 120px; margin: auto;">Procurar</label>
				</div>

				<div>
					<div class="product-codes grid g-c2a">
						<div class="input-wrapper">
							<label>Código Automático</label>
							<input class="disabled" disabled type="text" name="id" min="1" value="<?= $product["id"] ?>" style="background-color: #eee;">
						</div>

						<div class="input-wrapper">
							<label>Código de Barras</label>
							<input autocomplete="off" type="text" name="barcode" value="<?= $product["barcode"] ?>">
						</div>
					</div>

					<div class="input-wrapper" style="width: 100%">
						<label>Descrição do Produto</label>
						<input type="text" name="description" value="<?= $product["description"] ?>" autocomplete="off" autofocus="on" onfocus="this.selectionStart = this.selectionEnd = this.value.length;">
						<span class="error"><?= $this->util->getErrorMessage("description") ?></span>
					</div>
				</div>

				<div class="product-selects">
					<div class="product-unity-brand">
						<div class="input-wrapper">
							<label>Unidade</label>
							
							<div class="flex">
								<select name="unities">
									<option value="0">Selecione a Unidade</option>
									<?php foreach ($unities as $d) : ?>
										<option value="<?= $d["id"] ?>" <?= ($product["unity_id"] == $d["id"]) ? "selected='true'" : "" ?>><?= $d["name"] .((! empty($d["abbreviation"])) ? " (" .$d["abbreviation"] .")" : "") ?></option>
									<?php endforeach; ?>
								</select>
								<a class="btn btn-option" href="<?= URL ?>products/new/unity" title="Adicionar Unidade"><span class="add-icon"></span></a>
							</div>
						</div>

						<div class="input-wrapper">
							<label>Marca</label>

							<div class="flex">
								<select name="brands">
									<option value="0">Selecione a Marca</option>
									<?php foreach ($brands as $d) : ?>
										<option value="<?= $d["id"] ?>" <?= ($product["brand_id"] == $d["id"]) ? "selected='true'" : "" ?>><?= $d["name"] ?></option>
									<?php endforeach; ?>
								</select>
								<a class="btn btn-option" href="<?= URL ?>products/new/brand" title="Adicionar Unidade"><span class="add-icon"></span></a>
							</div>
						</div>
					</div>

					<div class="input-wrapper">
						<label>Categoria</label>

						<div class="flex">
							<select name="categories">
								<option value="0">Selecione a Categoria</option>
								<?php foreach ($categories as $d) : ?>
									<option value="<?= $d["id"] ?>" <?= ($product["category_id"] == $d["id"]) ? "selected='true'" : "" ?>><?= $d["name"] ?></option>
								<?php endforeach; ?>
							</select>
							<a class="btn btn-option" href="<?= URL ?>products/new/category" title="Adicionar Unidade"><span class="add-icon"></span></a>
						</div>
					</div>
				</div>
			</div>
		</fieldset>

		<fieldset class="price-field">
			<legend>Financeiro</legend>

			<div class="grid g-c2-a">
				<div class="input-wrapper">
					<label>Margem de Lucro (%)</label>
					<input autocomplete="off" type="text" name="gain-percent" value="<?= number_format((float) $product["gain_percent"], 2, ",", "") ?>" onfocus="selectAll.call(this)">
				</div>

				<div class="product-prices">
					<div class="input-wrapper">
						<label>Preço de Custo (R$)</label>
						<input autocomplete="off" type="text" name="price-cost" value="<?= number_format((float) $product["price_cost"], 2, ",", "") ?>" onfocus="selectAll.call(this)">
						<span class="error"><?= $this->util->getErrorMessage("price-cost") ?></span>
					</div>

					<div class="input-wrapper">
						<label>Preço de Venda (R$)</label>
						<input autocomplete="off" type="text" name="price-sell" value="<?= number_format((float) $product["price_sell"], 2, ",", "") ?>" onfocus="selectAll.call(this)">
						<span class="error"><?= $this->util->getErrorMessage("price-sell") ?></span>
					</div>
				</div>
			</div>
		</fieldset>

		<fieldset class="stock-field">
			<legend>Estoque</legend>

			<div class="grid g-c2-b">
				<div class="product-stock">
					<div class="input-wrapper">
						<label>Qtd em Estoque</label>
						<input type="number" name="stock" min="0" value="<?= (! empty($product["stock"])) ? $product["stock"] : "0" ?>">
					</div>

					<div class="input-wrapper">
						<label>Estoque Mínimo</label>
						<input type="number" name="stock-min" min="0" value="<?= (! empty($product["stock_min"])) ? $product["stock_min"] : "10" ?>">
					</div>
				</div>

				<div class="input-wrapper">
					<label>Produto está Ativo:</label>

					<input id="active-yes" type="radio" name="active" value="1" checked <?= ($product["active"] == 1) ? "checked" : "" ?>>
					<label for="active-yes" style="display: inline-block;">Sim</label>

					<input id="active-no" type="radio" name="active" value="2" <?= ($product["active"] == 2) ? "checked" : "" ?> style="margin-left: 1rem;">
					<label for="active-no" style="display: inline-block;">Não</label>
					<!-- <select name="active">
						<option value="1" <?php #echo ($product["active"] == 1) ? "selected" : ""; ?>>Sim</option>
						<option value="2" <?php #echo ($product["active"] == 2) ? "selected" : ""; ?>>Não</option>
					</select> -->
				</div>

				<!-- <label>Localização</label>
				<input autocomplete="off" type="text" name="location" value="<?= $product["location"] ?>"> -->
		</fieldset>

		<div style="margin-bottom: 2rem;">
			<input class="form-btn form-btn-green" type="submit" name="save" value="Salvar">
			<input class="form-btn" type="submit" name="cancel" value="Cancelar">	
		</div>
	</form>
</section>