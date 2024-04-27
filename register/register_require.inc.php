<!-- register_require.inc.php -->
<?php 

	if(!isset($_SESSION)) session_start();
	$config_file = "config.register.php";

	if (!file_exists($config_file)) {
		echo "<script>history.back();</script>";
	}
	else {
		
		include $config_file;

		require '../includes/classLoader.inc.php';
		require '../includes/functions.inc.php';

		date_default_timezone_set('Africa/Lubumbashi');
	}
?>