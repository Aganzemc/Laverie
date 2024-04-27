<!-- require.caisse.php -->
<?php
	$config_file = "config.caisse.php";

	if (!file_exists($config_file)) {
		echo "<script>history.back();</script>";
	}
	else {
		include $config_file;
	}
?>