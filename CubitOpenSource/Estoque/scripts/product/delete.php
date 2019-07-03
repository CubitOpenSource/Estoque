<?php
if (! empty($ids)) {
	$ids = explode("-", $ids);
	foreach ($ids as $id) {
		if (! empty($id)) {
			$this->dbAdmin->findTable("products")->delete($id);
		}
	}	
}
$this->util->redirect("products");