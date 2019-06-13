<section class="main-container">
	<h1>Nova Unidade</h1>

	<form id="unity-form" method="POST" onsubmit="callAjax(); return false;">
		<input type="hidden" name="src-url" value="<?= URL ?>">
		<input id="script-url" type="hidden" name="script-url" value="<?= URL ?>CubitOpenSource/Estoque/scripts/product/newUnity.php">

		<div class="input-wrapper">
			<label>Unidade</label>
			<input autofocus="on" type="text" name="unity-name">
		</div>

		<div class="input-wrapper">
			<label>Abreviação (Opcional)</label>
			<input type="text" name="unity-abbreviation">
		</div>
		
		<input id="unity-submit" class="form-btn form-btn-green" type="submit" name="save-unity" value="Salvar">
		<input class="form-btn" type="submit" name="cancel-unity" value="Cancelar" onclick="closeModal()">
	</form>
</section>