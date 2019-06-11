<section class="main-container">
	<h1>Nova Unidade</h1>
	<form name="unity-form" method="POST" action="<?= URL ?>CubitOpenSource/Estoque/scripts/product/newUnity.php">
		<!-- TODO: AJAX to call form action -->
		<input type="hidden" name="src-url" value="<?= URL ?>">

		<div class="input-wrapper">
			<label>Unidade</label>
			<input autofocus="on" type="text" name="unity-name">
		</div>

		<div class="input-wrapper">
			<label>Abreviação (Opcional)</label>
			<input type="text" name="unity-abbreviation">
		</div>
		
		<input class="form-btn form-btn-green" type="submit" name="save-unity" value="Salvar">
		<input class="form-btn" type="submit" name="cancel-unity" value="Cancelar">
	</form>
</section>