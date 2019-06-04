<section class="main-container">
	<h1>Novo Produto</h1>

	<form name="product" method="POST" enctype="multipart/form-data">

		<div class="flex-wrapper">
			<div class="input-wrapper">
				<label>Código</label>
				<input disabled="on" type="number" name="id" min="1" autofocus="on" value="<?= $product["id"] ?>" style="width: 5em">
			</div>
			<div class="input-wrapper">
				<label>Código de Barras</label>
				<input type="text" name="barcode" value="<?= $product["barcode"] ?>">
			</div>
		</div>

		<div class="flex-wrapper">
			<div class="input-wrapper" style="width: 100%">
				<label>Descrição:</label>
				<input type="text" name="description" value="<?= $product["description"] ?>">
				<span class="error"><?= $this->util->getErrorMessage("description") ?></span>
			</div>
			
			<div class="input-wrapper">
				<label>Unidade</label>
				<div style="display: flex; align-items: center;">
				<select name="unity">
					<option value="0"></option>
				</select>
				<a id="add-product-unity" class="btn btn-option" href="#"><i class="fas fa-plus"></i></a>
				</div>
			</div>

			<div class="input-wrapper">
				<label>Marca:</label>
				<select name="brand">
					<option value="0"></option>
				</select>
			</div>

			<div class="input-wrapper">
				<label>Categoria:</label>
				<select name="category">
					<option value="0"></option>
				</select>
			</div>
		</div>
		<div class="input-wrapper">
			<label>Imagem do Produto:</label>
			<input type="file" name="image">
		</div>

		

		<fieldset>
			<legend>Financeiro</legend>

			<label>Margem de Lucro</label>
			<input type="text" name="gain-percent" value="<?= $product["gain_percent"] ?>">

			<label>Preço de Custo</label>
			<input type="text" name="price-cost" value="<?= $product["price_cost"] ?>">
			<span class="error"><?= $this->util->getErrorMessage("price-cost") ?></span>

			<label>Preço de Venda</label>
			<input type="text" name="price-sell" value="<?= $product["price_sell"] ?>">
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

	select {
		width: 100%;
	}
</style>