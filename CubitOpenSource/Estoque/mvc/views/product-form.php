<script src="<?= URL ?>assets/js/util.js"></script>
<section class="main-container">
	<h1>Novo Produto</h1>

	<form class="grid" name="product" method="POST" enctype="multipart/form-data">
		<input type="hidden" name="operation" value="<?= (empty($id)) ? 0 : 1 ?>">

		<fieldset class="general-field">
			<legend>Geral</legend>

			<div style="display: grid; grid-template-columns: 0.2fr 1fr; justify-content: center;">
				<div class="input-wrapper">
					<label>Imagem do Produto</label>

					<div class="image-preview" style="display: flex; align-items: center; justify-content: center; width: 120px; height: 120px; border: 1px solid #ccc; overflow: hidden;">
						<img id="image-preview" src="<?= URL ."assets/img/" ?><?= (! empty($product["image"])) ? "products/" .$product["image"] : "no-picture.svg" ?>" style="max-width: 100%; max-height: 100%;">
					</div>
					
					<input id="file-input" class="input-file" type="file" name="image" onchange="updatePreviewImage.call(this)">
					<label for="file-input" class="btn btn-default" style="width: 120px;">Procurar</label>
				</div>

				<div class="grid g-c2a">
					<div class="input-wrapper">
						<label>Código Automático</label>
						<input class="disabled" disabled type="text" name="id" min="1" value="<?= $product["id"] ?>" style="background-color: #eee;">
					</div>

					<div class="input-wrapper">
						<label>Código de Barras</label>
						<input autocomplete="off" type="text" name="barcode" value="<?= $product["barcode"] ?>">
					</div>
				</div>

				<div class="grid">
					<div class="input-wrapper">
						<label>Descrição do Produto</label>
						<input type="text" name="description" value="<?= $product["description"] ?>" autocomplete="off" autofocus="on" onfocus="this.selectionStart = this.selectionEnd = this.value.length;">
						<span class="error"><?= $this->util->getErrorMessage("description") ?></span>
					</div>
				</div>
			</div>

			<div class="grid g-c3">
				<div class="input-wrapper">
					<label>Unidade</label>
					
					<div class="grid g-c2b">
						<select name="unity">
							<option value="0">Selecione a Unidade</option>
						</select>
						<a id="add-product-unity" class="btn btn-option" href="#" title="Adicionar Unidade"><span class="add-icon"></span></a>
					</div>
				</div>

				<div class="input-wrapper">
					<label>Marca</label>

					<div class="grid g-c2b">
						<select name="brand">
							<option value="0">Selecione a Marca</option>
						</select>
						<a id="add-product-unity" class="btn btn-option" href="#" style="display:block" title="Adicionar Marca"><span class="add-icon"></span></a>
					</div>
				</div>

				<div class="input-wrapper">
					<label>Categoria</label>

					<div class="grid g-c2b">
						<select name="category">
							<option value="0">Selecione a Categoria</option>
						</select>
						<a id="add-product-unity" class="btn btn-option" href="#" title="Adicionar Categoria"><span class="add-icon"></span></a>
					</div>
				</div>
			</div>			
		</fieldset>

		<fieldset class="price-field">
			<legend>Financeiro</legend>
			<div class="grid g-c3">
				<div class="input-wrapper">
					<label>Margem de Lucro (%)</label>
					<input autocomplete="off" type="text" name="gain-percent" value="<?= number_format((float) $product["gain_percent"], 2, ",", "") ?>" onfocus="selectAll.call(this)">
				</div>

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
		</fieldset>

		<fieldset class="stock-field">
			<legend>Estoque</legend>
			<div class="grid g-c3">
				<div class="input-wrapper">
					<label>Qtd em Estoque</label>
					<input type="number" name="stock" min="0" value="<?= (! empty($product["stock"])) ? $product["stock"] : "0" ?>">
				</div>

				<div class="input-wrapper">
					<label>Estoque Mínimo</label>
					<input type="number" name="stock-min" min="0" value="<?= (! empty($product["stock_min"])) ? $product["stock_min"] : "10" ?>">
				</div>

				<div class="input-wrapper">
					<label>Produto está Ativo:</label>

					<input id="active-yes" type="radio" name="active" value="1" checked <?= ($product["active"] == 1) ? "checked" : "" ?>>
					<label for="active-yes" style="display: inline-block;">Sim</label>
					<br>

					<input id="active-no" type="radio" name="active" value="2" <?= ($product["active"] == 2) ? "checked" : "" ?>>
					<label for="active-no" style="display: inline-block;">Não</label>
					
					<!-- <select name="active">
						<option value="1" <?php echo ($product["active"] == 1) ? "selected" : ""; ?>>Sim</option>
						<option value="2" <?php echo ($product["active"] == 2) ? "selected" : ""; ?>>Não</option>
					</select> -->
				</div>

				<!-- <label>Localização</label>
				<input autocomplete="off" type="text" name="location" value="<?= $product["location"] ?>"> -->
		</fieldset>

		<div>
			<input type="submit" name="save" value="Salvar">
			<input type="submit" name="cancel" value="Cancelar">	
		</div>
	</form>
</section>

<style>
	.grid {
		display: grid;
		grid-gap: 1rem;
		grid-template-areas:
		"general general"
		"stock price"
		"buttons buttons";
	}

	.general-field {
		grid-area: general;
	}

	.stock-field {
		grid-area: stock;
	}

	.price-field {
		grid-area: price;
	}

	.g-c2 {
		grid-template-columns: repeat(2, 1fr);
	}

	.g-c2a { grid-template-columns: 0.5fr 1fr; }
	.g-c2b { grid-template-columns: 1fr 0.1fr; }

	.g-c3 {
		grid-template-columns: repeat(3, 1fr);
	}

	body {
		background-color: #f9f9f9;
	}

	#file-input {
		display: none;
	}

	.input-wrapper label {
		display: block;
		margin: 0.5rem 0;
	}

	.input-wrapper input:not([type=radio]),
	.input-wrapper select
	{
		font-size: 1.25rem;
		width: 100%;
		margin: 0.5rem 0 1rem 0;
		padding: 0.5rem 1rem;
		background-color: white;
		border: 1px solid #eee;
		border-bottom: 2px solid #aaa;
		outline: unset;
		color: #444;
	}

	.input-wrapper input:focus,
	.input-wrapper select:focus {
		background-color: rgba(255, 255, 0, 0.4);
	}
	
	.add-icon {
		display: block;
		width: 16px;
		height: 16px;
		margin-top: 0.5rem;
		background-image: url("<?= URL ?>assets/img/add.svg");
	}
</style>