<!-- classLoader.inc.php -->
<?php
	spl_autoload_register('autoLoader');
	function autoLoader($className){
		$path = "classes/";
		$ext = ".class.php";
		$fullPath = $path . $className . $ext;
		if (file_exists($fullPath)) include_once $fullPath;
		elseif(file_exists("../". $fullPath)) include_once '../'. $fullPath;
		elseif(file_exists("../../". $fullPath)) include_once '../../'. $fullPath;
		elseif(file_exists("../../../". $fullPath)) include_once '../../../'. $fullPath;
		else return false;
	}
?>