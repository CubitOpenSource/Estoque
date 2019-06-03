<form name="product" method="POST">
	<input type="hidden" name="id">

	<label>Cógigo do Produto:</label>
	<input type="number" name="code" min="1" autofocus="on">

	<label>Código de Barras:</label>
	<input type="text" name="barcode">

	<label>Nome:</label>
	<input type="text" name="name">

	<label>Descrição:</label>
	<input type="text" name="description">

	<label>Unidade</label>
	<select name="unity">
		<option value="1">UN</option>
	</select>

	<fieldset>
		<legend>Financeiro</legend>

		<label>Preço de Compra</label>
		<input type="text" name="price-a">

		<label>Preço de Venda</label>
		<input type="text" name="price-b">

		<label>Margem de Lucro</label>
		<input type="text" name="gain-percent">
	</fieldset>

	<fieldset>
		<legend>Estoque</legend>

		<label>Qtd em Estoque</label>
		<input type="number" name="stock" min="0">

		<label>Estoque Mínimo</label>
		<input type="number" name="min-stock" min="0">

		<label>Localização</label>
		<input type="text" name="location">
	</fieldset>

	<fieldset>
		<legend>Outras Opções</legend>

		<label>Produto está Ativo:</label>
		<select name="active">
			<option value="1">Sim</option>
			<option value="2">Não</option>
		</select>
	</fieldset>
</form>