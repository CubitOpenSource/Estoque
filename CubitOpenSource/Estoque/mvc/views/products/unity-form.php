<link rel="stylesheet" href="<?= URL ?>CubitOpenSource/Estoque/mvc/views/products/css/form.css">

<section class="main-container">
	<h1>Nova Unidade</h1>

	<form method="POST">
		<div class="input-wrapper">
			<label>Unidade (*)</label>
			<input autofocus="on" type="text" name="name" value="<?= (! empty($_POST["name"])) ? $_POST["name"] : "" ?>">
			<span class="error"><?= $this->util->getErrorMessage("name") ?></span>
		</div>

		<div class="input-wrapper">
			<label>Abreviação</label>
			<input type="text" name="abbreviation" value="<?= (! empty($_POST["abbreviation"])) ? $_POST["abbreviation"] : "" ?>">
		</div>
		
		<input class="form-btn form-btn-green" type="submit" name="save" value="Salvar">

		<input class="form-btn" type="submit" name="cancel" value="Cancelar">
	</form>
</section>