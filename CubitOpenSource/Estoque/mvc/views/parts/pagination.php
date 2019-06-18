<div class="pagination">
	<a href="<?= URL ?>products/list?p=<?= $currentPage - 1 ?>" title="Página Anterior" class="btn btn-default <?= ($currentPage <= 1 || $maxPages <= 1) ? "disabled" : "" ?>">&#10094;</a>

	<select id="select-pages" class="btn btn-default <?= ($maxPages <= 1) ? "disabled" : "" ?>" title="Página Atual: <?= $currentPage ?>" <?= ($maxPages <= 1) ? "disabled='on'" : "" ?> onchange="goToPage(this.options[this.selectedIndex].value)">
		<?php for ($i = 0; $i < $maxPages; $i++) : ?>
			<option value="<?= $i + 1 ?>" <?= ($currentPage == $i + 1) ? "selected='true'" : "" ?>><?= $i + 1 ?></option>
		<?php endfor; ?>
	</select>

	<a href="<?= URL ?>products/list?p=<?= $currentPage + 1 ?>" title="Próxima Página" class="btn btn-default <?= ($currentPage == $maxPages || $maxPages <= 1) ? "disabled" : "" ?>">&#10095;</a>

	<select id="select-max" class="btn btn-default" title="Número de produtos a serem exibidos por página. O número atual é <?= $itemsPerPage ?>." onchange="displayMax(this.options[this.selectedIndex].value)">
		<option value="10" <?= ($itemsPerPage == 10) ? "selected='true'" : "" ?>>10</option>
		<option value="25" <?= ($itemsPerPage == 25) ? "selected='true'" : "" ?>>25</option>
		<option value="50" <?= ($itemsPerPage == 50) ? "selected='true'" : "" ?>>50</option>
		<option value="100" <?= ($itemsPerPage == 100) ? "selected='true'" : "" ?>>100</option>
	</select>
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
		margin-left: 1rem;
	}

	.disabled {
		pointer-events: none;
		cursor: default;
		color: #ccc;
	}

	#select-max {
		margin-left: 1rem;
	}

	select.btn-default {
		padding-left: 0.35rem;
		padding-right: 0.35rem;
	}
</style>