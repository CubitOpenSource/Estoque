<?php $title = "New Product"; ?>
<?php include "../template/page-top.php"; ?>

<form name="product" method="POST">
	<input type="hidden" name="id">

	<input type="number" name="code">

	<input type="text" name="name" placeholder="Product Name:">
</form>

<?php include "./CubitOpenSource/Estoque/template/page-bottom.php"; ?>