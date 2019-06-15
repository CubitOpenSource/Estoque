<link rel="stylesheet" href="<?= URL ?>CubitOpenSource/Estoque/mvc/views/products/css/form.css">

<section class="main-container">
	<h1>Nova Marca</h1>

	<form method="POST">
		<div class="input-wrapper">
			<label>Marca (*)</label>
			<input autofocus="on" type="text" name="name" value="<?= (! empty($_POST["name"])) ? $_POST["name"] : "" ?>">
			<span class="error"><?= $this->util->getErrorMessage("name") ?></span>
		</div>

		<input class="form-btn form-btn-green" type="submit" name="save" value="Salvar">
		<input class="form-btn" type="submit" name="cancel" value="Cancelar">
	</form>
</section>