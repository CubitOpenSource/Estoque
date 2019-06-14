<link rel="stylesheet" href="<?= URL ?>CubitOpenSource/Estoque/mvc/views/products/css/form.css">

<section class="main-container">
	<h1>Nova Unidade</h1>

	<form id="unity-form" method="POST">
		<input type="hidden" name="src-url" value="<?= URL ?>">
		<input id="script-url" type="hidden" name="script-url" value="<?= URL ?>CubitOpenSource/Estoque/scripts/product/newUnity.php">

		<div class="input-wrapper">
			<label>Unidade (*)</label>
			<input autofocus="on" type="text" name="unity-name" value="<?= (! empty($_POST["unity-name"])) ? $_POST["unity-name"] : "" ?>">
			<span class="error"><?= $this->util->getErrorMessage("name") ?></span>
		</div>

		<div class="input-wrapper">
			<label>Abreviação</label>
			<input type="text" name="unity-abbreviation" value="<?= (! empty($_POST["unity-abbreviation"])) ? $_POST["unity-abbreviation"] : "" ?>">
		</div>
		
		<input id="unity-submit" class="form-btn form-btn-green" type="submit" name="save-unity" value="Salvar">

		<input class="form-btn" type="submit" name="cancel-unity" value="Cancelar">
	</form>
</section>