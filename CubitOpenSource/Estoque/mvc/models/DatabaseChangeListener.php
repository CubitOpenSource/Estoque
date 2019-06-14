<?php

class DatabaseChangeListener implements Listener
{
	public function update()
	{
		echo "O banco de dados foi alterado.";
	}
}