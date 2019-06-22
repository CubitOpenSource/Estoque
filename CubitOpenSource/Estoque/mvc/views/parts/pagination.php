<div class="pagination">
	<a href="<?= URL ?>products/list?p=<?= $currentPage - 1 ?>" title="Página Anterior" class="btn btn-default <?= ($currentPage <= 1 || $maxPages <= 1) ? "disabled" : "" ?>"><i class="fa fa-angle-left"></i></a>

	<select id="select-pages" name="page" class="btn btn-default <?= ($maxPages <= 1) ? "disabled" : "" ?>" title="Página Atual: <?= $currentPage ?>" <?= ($maxPages <= 1) ? "disabled='on'" : "" ?> onchange="this.form.submit()">
		<option value="-1" disabled="on">Página</option>
		<?php for ($i = 0; $i < $maxPages; $i++) : ?>
			<option value="<?= $i + 1 ?>" <?= ($currentPage == $i + 1) ? "selected='true'" : "" ?>><?= $i + 1 ?></option>
		<?php endfor; ?>
	</select>

	<a href="<?= URL ?>products/list?p=<?= $currentPage + 1 ?>" title="Próxima Página" class="btn btn-default <?= ($currentPage == $maxPages || $maxPages <= 1) ? "disabled" : "" ?>"><i class="fa fa-angle-right"></i></a>

	<div class="input-group" style="margin-left: 0.6rem;">
		<select id="select-max" name="items" title="Número de produtos a serem exibidos por página. O número atual é <?= $itemsPerPage ?>." onchange="this.form.submit()">
			<option value="-1" disabled="on">Produtos por Página</option>
			<option value="10" <?= ($itemsPerPage == 10) ? "selected='true'" : "" ?>>10</option>
			<option value="25" <?= ($itemsPerPage == 25) ? "selected='true'" : "" ?>>25</option>
			<option value="50" <?= ($itemsPerPage == 50) ? "selected='true'" : "" ?>>50</option>
			<option value="100" <?= ($itemsPerPage == 100) ? "selected='true'" : "" ?>>100</option>
		</select>
	</div>
</div>

<script>
	function goToPage(p) {
		var select = document.getElementById("select-pages");
		var max = parseInt("<?= $maxPages ?>");
		if (p <= 0 || p > max) { return false; }

		url = "<?= URL ?>" + "products/list?p=" + p;
		window.location.href = url;
	}

	function displayMax(v) {
		p = "<?= $currentPage ?>";
		url = "<?= URL ?>" + "products/list?p=" + p + "&s=" + v;
		window.location.href = url;
	}
</script>

<style>
	.pagination {
		display: flex;
		/*margin-left: 1rem;*/
	}

	.disabled {
		pointer-events: none;
		cursor: default;
		color: #ccc;
	}

	.pagination .btn {
		font-size: 0.9rem;
		padding: 0.5rem 1rem;
		text-transform: lowercase;
	}

	select.btn-default {
		padding-left: 0.35rem;
		padding-right: 0.35rem;
	}

	#select-max {
		cursor: pointer;
	}
</style>