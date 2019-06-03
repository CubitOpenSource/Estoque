<h1>Products</h1>
<section class="products">
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
						<a class="post-title" href="<?= URL ?>product/edit/<?= $product["id"] ?>"><?= $product["description"] ?></a>
					</div>
					
					<div class="options">
						<a class="item" href="<?= URL ?>product/edit<?= $product["id"] ?>">Edit</a>
						<div class="item">|</div>
						<a class="item" target="_blank" href="<?= URL ?>product/view/<?= $product["id"] ?>">View</a>
						<div class="item">|</div>
						<a class="item" href="<?= URL ?>product/delete/<?= $product["id"] ?>">Delete</a>
					</div>
						
				</td>

				<td><?= $product["price_sell"] ?></td>

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
		display: flex;
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