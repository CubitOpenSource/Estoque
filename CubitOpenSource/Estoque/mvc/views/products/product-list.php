<script>
	function toggleSelectCheckboxes(source) {
		var checkboxes = document.querySelectorAll('input[type="checkbox"]');
		for (var i = 0; i < checkboxes.length; i++) {
		    if (checkboxes[i] != source) {
		        checkboxes[i].checked = source.checked;

		        // bug below

		        var parent = checkboxes[i].parentElement.parentElement;
		        // alert(checkboxes[i].checked + " " +parent.className);
		        if (parent) {
		        	if (parent.className == "") {
		        		if (checkboxes[i].checked) {
		        			parent.setAttribute("class", "selected");
		        		}		        		
		        	} else {
		        		parent.removeAttribute("class");
		        	}
		        }
		    }
		}
	}

	function toggleSelectRow(row) {
		if (this) {
			if (this.className == "") {
				this.setAttribute("class", "selected");
				this.getElementsByClassName("checkbox")[0].setAttribute("checked", "true");
			} else {
				this.removeAttribute("class");
				this.getElementsByClassName("checkbox")[0].removeAttribute("checked");
			}
		}
	}

	window.onload = function() {
		var as = document.getElementsByTagName("a");
		for (var i = 0; i < as.length; i++) {
			as[i].addEventListener("click", function() {
				if (this.parentElement) {
					if (this.parentElement.parentElement) {
						if (this.parentElement.parentElement.parentElement) {
							var tr = this.parentElement.parentElement.parentElement;
							tr.setAttribute("class", " ");
							// tr.getElementsByClassName("checkbox")[0].removeAttribute("checked");
						}
					}
				}
			}, 1);
		}
	}

	function openSubMenu(e) {
		if (e) {
		e.preventDefault();}
		alert("Abriu");

	}
</script>

<style>
	.option {
		background: linear-gradient(to bottom,#f5f5f5,#f1f1f1);
		border-radius: 2px;
		border: 1px solid rgba(0,0,0,0.1);
		color: #444;
		display: block;
		font-size: 11px;
		font-weight: bold;
		height: 27px;
		line-height: 27px;
		padding: 0 10px;
		position: relative;
		text-align: center;
		text-decoration: none;
		transition: all .2s;
		vertical-align: middle;
	}
	.option:hover {
		background: linear-gradient(to bottom,#f6f6f6,#f1f1f1);
		border: 1px solid #bbb;
		box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
		text-decoration: none;
		z-index: 1;
	}
	.option:focus {
		border: 1px solid #4d90fe;
		outline: none;
		z-index: 1;
	}

	.opt {
		display: inline-block;
	}

	.option-wrapper {
		display: flex;
		align-items: center;
	}
	.option-wrapper .item {
		margin-left: 0.5rem;
	}
	.option-wrapper .item:first-child {
		margin-left: 0;
	}


	.list-options ul {
		display: grid;
		grid-template-columns: repeat(2, 1fr);
		grid-gap: 0.5rem;
		text-align: center;
	}

	.list-options ul li a {
		display: block;
		padding: 1em;
		background-color: whitesmoke;
	}

	.sort-options ul li ul {
		display: none;
	}
</style>

<section class="products">
	<div class="main-container">
		<h1>Produtos</h1>
		
		<a class="btn btn-default" href="<?= URL ?>products/new">Cadastrar Produto</a>

		<nav id="sort-options">
			<ul>
				<li>
					<a href="#" onclick="openSubMenu()">Preço</a>
					<ul>
						<li><a href="#">Menor Preço</a></li>
						<li><a href="#">Maior Preço</a></li>
					</ul>
				</li>
				<li>
					<a href="#">Estoque</a>
					<ul>
						<li><a href="#">Estoque Baixo</a></li>
						<li><a href="#">Estoque Alto</a></li>
					</ul>
				</li>
			</ul>
		</nav>

		<div class="list-options">
			<button><i class="fas fa-sliders-h"></i> Filtrar</button>
			<button><i class="fas fa-sort"></i> Ordenar</button>
		</div>

		<br>
		<label>Filtrar por:</label>

		<div class="filter">
			<div class="input-group">
				<select id="select-categories" name="category" title="Mostrar por Categoria" name="filter" onchange="this.form.submit()">
					<option value="0" <?= ($category == 0) ? "selected='true'" : "" ?>>Categoria</option>
					<option value="-1" <?= ($category == -1) ? "selected='true'" : "" ?>>Sem Categoria<?= " (" .$noCategoryProducts .")" ?></option>
					<?php foreach ($categories as $c) : ?>
						<?php $i++; ?>
						<option value="<?= $i ?>" <?= ($category == $c["id"]) ? "selected='true'" : "" ?>><?= $c["name"] . " (" .$c["products"] .")" ?></option>
					<?php endforeach; ?>
				</select>
			</div>

			<div class="input-group">
				<select name="brand">
					<option value="0">Marca</option>
				</select>
			</div>

			<div class="input-group">
				<select name="unity">
					<option value="0">Unidade</option>
				</select>
			</div>

			<button class="btn btn-default">Limpar</button>
		</div>

		<br>
		<label>Ordenar por:</label>

		<div class="order">
			<div class="input-group">
				<select name="price">
					<option value="0">Preço</option>
					<option value="1">Menor Preço</option>
					<option value="2">Maior Preço</option>
				</select>
			</div>

			<div class="input-group">
				<select name="stock">
					<option value="0">Estoque</option>
					<option value="1">Estoque Baixo</option>
					<option value="2">Estoque Normal</option>
					<option value="3">Estoque Alto</option>
				</select>
			</div>

			<button class="btn btn-default">Limpar</button>
		</div>

		<form action="<?= URL ?>products/list">
			<div class="option-wrapper">
				<span class="item" style="display: flex; align-items: center;">
					<input id="select-all" type="checkbox" name="select-all" onclick="toggleSelectCheckboxes(this);">
					<label for="select-all" style="margin-left: 0.5rem;">Marcar tudo</label>
				</span>

				<a id="delete-selected" class="item btn btn-default" href="#"><i class="fas fa-trash"></i></a>
			</div>

			<div class="input-group">
				<select id="select-categories" name="category" title="Mostrar por Categoria" name="filter" onchange="this.form.submit()">
					<option value="0" <?= ($category == 0) ? "selected='true'" : "" ?>>Todas as Categorias</option>
					<option value="-1" <?= ($category == -1) ? "selected='true'" : "" ?>>Sem Categoria<?= " (" .$noCategoryProducts .")" ?></option>
					<?php foreach ($categories as $c) : ?>
						<?php $i++; ?>
						<option value="<?= $i ?>" <?= ($category == $c["id"]) ? "selected='true'" : "" ?>><?= $c["name"] . " (" .$c["products"] .")" ?></option>
					<?php endforeach; ?>
				</select>
			</div>

			<div class="input-group">
				<input type="search" title="Buscar Produtos" name="search" placeholder="Buscar" value="<?= $search ?>">
			</div>

			<?php $this->loadViewPart("pagination", $data); ?>
		</form>
	</div>
	
	<table class="list-table">
		<thead>
			<tr>
				<th></th>
				<?php foreach ($columns as $th) : ?>
					<th><?= $th ?></th>
				<?php endforeach; ?>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($products as $product) : ?>
			<tr onclick="toggleSelectRow.call(this)">
				<td>
					<input class="checkbox" type="checkbox" name="selected[]">
				</td>

				<td><?= $product["id"] ?></td>

				<!-- <td><img src="<?= URL ."assets/img/" ?><?= (! empty($product["image"])) ? "products/" .$product["image"] : "no-picture.svg" ?>" style="max-width: 60px;"></td> -->

				<td style="text-align: left;">
					<div>
						<a class="post-title" href="<?= URL ?>products/edit/<?= $product["id"] ?>" title="<?= $product["description"] ?>"><?= (strlen($product["description"]) <= 40) ? $product["description"] : substr($product["description"], 0, 40) ."..." ?></a>
					</div>
					
					<div class="options">
						<a class="item" href="<?= URL ?>products/edit/<?= $product["id"] ?>">Editar</a>
						<div class="item">|</div>
						<!-- <a class="item" target="_blank" href="<?= URL ?>products/view/<?= $product["id"] ?>">Visualizar</a>
						<div class="item">|</div> -->
						<a class="item" href="<?= URL ?>products/delete/<?= $product["id"] ?>">Apagar</a>
					</div>
				</td>

				<td><?= $product["category_name"] ?></td>

				<td><?= $product["stock"] ?></td>

				<!-- <td>R$ <?= number_format((float) $product["price_sell"], 2, ",", "") ?></td>

				<td><?= date("d/m/Y", strtotime($product["created_at"])) ?></td> -->

			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>

	<table class="options-table">
		<tr>
			<td>
				<?php $this->loadViewPart("pagination", $data); ?>
			</td>
		</tr>
	</table>
</section>

<style>
	table {
		width: 100%;
		border-collapse: collapse;
	}

	table td {
		padding: 0.5rem;
		text-align: center;
		border-bottom: 1px solid #ebebeb;
	}
	
	.list-table .selected {
		background-color: #fff9e7;
	}

	.list-table tr:hover .options { visibility: visible; }
	.list-table tr:first-child td { border-top: 1px solid #ebebeb; }

	.post-title { font-weight: 600; color: dodgerblue; }

	.options {
		visibility: hidden;
		display: inline-flex;
		margin-top: 0.5rem;
		font-size: 0.8rem;
		color: dodgerblue;
	}
	.options a { color: dodgerblue; }
	.options .item { margin-right: 0.25rem; }
	.options .item:last-child { margin-right: 0; }

	.draft { margin: 0 0.5em; font-style: italic; color: red; }
</style>