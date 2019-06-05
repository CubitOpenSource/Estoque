<?php
if (! empty($id)) {
	$this->dbAdmin->findTable("products")->delete($id);
}
$this->util->redirect("product/list");