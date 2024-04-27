<?php 
	$files_to_delete = array("infoclient.info.json");
	foreach ($files_to_delete AS $file){
		if (file_exists($file)) {
			unlink($file);
		}
	}
	header("location:http://localhost/laverie/logout.php");
?>