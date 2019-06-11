<?php

if ($this->util->checkMethod("POST")) {
	if (! empty($_POST["save-unity"])) {
		var_dump($_POST); die;
		
		if (! empty($_POST["unity-name"])) {
			$a = array();
			$a["name"] = $_POST["unity-name"];
			$a["abbreviation"] = $_POST["unity-abbreviation"];

			$this->dbMan()->findTable("unities").insert($a);
			// closeModal();
		}
	} elseif (! empty($_POST["cancel-unity"])) {
		closeModal();
	}
}

function closeModal()
{
	?>
	closeModal();
	<?php
	die;
}