<script src="<?= URL ?>assets/js/util.js"></script>
<section class="main-container">
	<h1>Novo Produto</h1>

	<form name="product" method="POST" enctype="multipart/form-data">
		<fieldset>
			<legend>Geral</legend>
			<div class="grid g-c2a">
				<div class="input-wrapper">
					<label>Código Automático</label>
					<input style="width: 100%" disabled="on" type="number" name="id" min="1" autofocus="on" value="<?= $product["id"] ?>" style="width: 5em">
				</div>

				<div class="input-wrapper">
					<label>Código de Barras</label>
					<input type="text" name="barcode" value="<?= $product["barcode"] ?>">
				</div>
			</div>

			<div class="grid">
				<div class="input-wrapper">
					<label>Descrição do Produto</label>
					<input style="width: 100%" type="text" name="description" value="<?= $product["description"] ?>">
					<span class="error"><?= $this->util->getErrorMessage("description") ?></span>
				</div>
				
				<div class="input-wrapper">
					<label>Imagem do Produto</label>

					<div class="grid g-c2a">
						<div class="image-preview" style="display: flex; align-items: center; justify-content: center; width: 120px; height: 120px; border: 1px solid; overflow: hidden;">
							<img id="image-preview" src="<?= URL ?>assets/img/products/<?= $product["image"] ?>" style="max-width: 100%; max-height: 100%;">
						</div>
						<input id="file-input" type="file" name="image" onchange="updatePreviewImage.call(this)">
					</div>
				</div>
			</div>

			<div class="grid g-c3">
				<div class="input-wrapper">
					<label>Unidade</label>
					
					<div class="grid g-c2b">
						<select name="unity">
							<option value="0"></option>
						</select>
						<a id="add-product-unity" class="btn btn-option" href="#" style="display:block"><i class="fas fa-plus"></i></a>
					</div>
				</div>

				<div class="input-wrapper">
					<label>Marca</label>

					<div class="grid g-c2b">
						<select name="brand">
							<option value="0"></option>
						</select>
						<a id="add-product-unity" class="btn btn-option" href="#" style="display:block"><i class="fas fa-plus"></i></a>
					</div>
				</div>

				<div class="input-wrapper">
					<label>Categoria</label>

					<div class="grid g-c2b">
						<select name="category">
							<option value="0"></option>
						</select>
						<a id="add-product-unity" class="btn btn-option" href="#" style="display:block"><i class="fas fa-plus"></i></a>
					</div>
				</div>
			</div>			
		</fieldset>
		

		<fieldset>
			<legend>Financeiro</legend>

			<label>Margem de Lucro</label>
			<input type="text" name="gain-percent" value="<?= number_format((float) $product["gain_percent"], 2, ".", "") ?>">

			<label>Preço de Custo</label>
			<input type="text" name="price-cost" value="<?= number_format((float) $product["price_cost"], 2, ".", "") ?>">
			<span class="error"><?= $this->util->getErrorMessage("price-cost") ?></span>

			<label>Preço de Venda</label>
			<input type="text" name="price-sell" value="<?= number_format((float) $product["price_sell"], 2, ".", "") ?>">
			<span class="error"><?= $this->util->getErrorMessage("price-sell") ?></span>
		</fieldset>


		<fieldset>
			<legend>Estoque</legend>

			<label>Qtd em Estoque</label>
			<input type="number" name="stock" min="0" value="<?= $product["stock"] ?>">

			<label>Estoque Mínimo</label>
			<input type="number" name="stock-min" min="0" value="<?= $product["stock_min"] ?>">

			<label>Localização</label>
			<input type="text" name="location" value="<?= $product["location"] ?>">
		</fieldset>


		<fieldset>
			<legend>Outras Opções</legend>

			<label>Produto está Ativo:</label>
			<select name="active">
				<option value="1" <?php echo ($product["active"] == 1) ? "selected" : ""; ?>>Sim</option>
				<option value="2" <?php echo ($product["active"] == 2) ? "selected" : ""; ?>>Não</option>
			</select>
		</fieldset>


		<input type="submit" name="save" value="Save">
	</form>
</section>

<style>
	.grid {
		display: grid;
		grid-gap: 1rem;
		align-items: stretch;
	}

	.g-c2 {
		grid-template-columns: repeat(2, 1fr);
	}

	.g-c2a { grid-template-columns: 0.5fr 1fr; }
	.g-c2b { grid-template-columns: 1fr 0.1fr; }

	.g-c3 {
		grid-template-columns: repeat(3, 1fr);
	}

	label {
		font-size: 1.25rem;
	}

	input {
		font-size: 1.5rem;
	}

	select, input {
		min-height: 2rem;
	}

	.flex-wrapper {
		display: flex;
		flex-wrap: wrap;
	}
	.flex-wrapper .input-wrapper {
		margin: 1em 1em 1em 0;
	}
	.flex-wrapper .input-wrapper:last-child {
		margin-right: 0;
	}

	.input-wrapper {
		display: inline-table;
	}
	.input-wrapper label {
		display: block;
		width: 100%;
		margin: 0.5rem 0;
	}
	.input-wrapper input {
		width: 100%;
	}

	select {
		width: 100%;
	}
</style>