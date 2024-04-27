<!-- loader.php -->
<?php 
	include "archives/Dirmanager.class.php";
	$obj_DirManager = new DirManager("images/");

	echo "<pre>";
		var_dump($obj_DirManager->getFolder());
	echo "</pre>";
?>