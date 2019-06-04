<section class="products main-container">
	<h1>Produtos</h1>
	
	<a class="btn btn-default" href="<?= URL ?>product/new">Cadastrar</a>

	<table>
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
				<td style="text-align: center;">
					<input class="checkbox" type="checkbox" name="selected[]">
				</td>

				<td><?= $product["id"] ?></td>

				<td>
					<div>
						<a class="post-title" href="<?= URL ?>product/edit/<?= $product["id"] ?>"><?= (strlen($product["description"]) <= 20) ? $product["description"] : substr($product["description"], 0, 20) ."..." ?></a>
					</div>
					
					<div class="options">
						<a class="item" href="<?= URL ?>product/edit/<?= $product["id"] ?>">Edit</a>
						<div class="item">|</div>
						<a class="item" target="_blank" href="<?= URL ?>product/view/<?= $product["id"] ?>">View</a>
						<div class="item">|</div>
						<a class="item" href="<?= URL ?>product/delete/<?= $product["id"] ?>">Delete</a>
					</div>
				</td>

				<td><?= $product["stock"] ?></td>

				<td>R$ <?= number_format((float) $product["price_sell"], 2, ".", "") ?></td>

				<td><?= date("d/m/Y", strtotime($product["created_at"])) ?></td>

			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</section>

<style>
	.products table {
		width: 100%;
		border-collapse: collapse;
	}
	
	.products table tr:hover .options { visibility: visible; }

	.products table td {
		padding: 0.5em;
		text-align: center;
		border-bottom: 1px solid #ebebeb;
	}

	.products table tr:first-child td {
		border-top: 1px solid #ebebeb;
	}

	.products table .selected {
		background-color: #fff9e7;
	}

	.post-title {
		font-weight: 600;
		color: dodgerblue;
	}

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

	.draft {
		margin: 0 0.5em;
		font-style: italic;
		color: red;
	}
</style>