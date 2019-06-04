<section class="main-container">
	<h1>Novo Produto</h1>

	<form name="product" method="POST" enctype="multipart/form-data">

		<div>
			<label>Cógigo do Produto:</label>
			<input disabled="on" type="number" name="id" min="1" autofocus="on" value="<?= $product["id"] ?>">

			<label>Código de Barras:</label>
			<input type="text" name="barcode" value="<?= $product["barcode"] ?>">	
		</div>
		

		<label>Unidade</label>
		<select name="unity">
			<option value="0"></option>
		</select>
		<a id="add-product-unity" class="btn btn-option" href="#"><i class="fas fa-plus"></i></a>

		<label>Descrição:</label>
		<input type="text" name="description" value="<?= $product["description"] ?>">
		<span class="error"><?= $this->util->getErrorMessage("description") ?></span>

		<label>Imagem do Produto:</label>
		<input type="file" name="image">

		<label>Marca:</label>
		<select name="brand">
			<option value="0"></option>
		</select>

		<label>Categoria:</label>
		<select name="category">
			<option value="0"></option>
		</select>

		
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
	input {
		width: 100%;
	}
</style>