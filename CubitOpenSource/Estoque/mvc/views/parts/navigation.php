<link rel="stylesheet" href="<?= URL ?>CubitOpenSource/Estoque/mvc/views/parts/css/navigation.css">

<div class="mcontainer">
	<nav class="breadcrumb-nav">
		<ul>
			<?php if (count($pages) > 1) : ?>
				<?php for ($i = 0; $i < count($pages); $i++) : ?>
					<?php $page = $pages[$i]; ?>
					<?php if ($i < count($pages) -1) : ?>
						<li><a href="<?= $page["url"] ?>"><?= $page["title"] ?></a></li>
					<?php else : ?>
						<li class="active"><?= $page["title"] ?></li>
					<?php endif; ?>
				<?php endfor; ?>
			<?php endif ?>		
		</ul>
	</nav>
</div>