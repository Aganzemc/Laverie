<!-- print_require.inc.php -->
<?php 
	if(!isset($_SESSION)) session_start();

	$dataFile = "print_data.json";
	define("DATA_FILE", $dataFile);

	if(isset($_SESSION['data']['print'])){

		$data = $_SESSION['data']['print'];
		file_put_contents(DATA_FILE, json_encode( $data, JSON_PRETTY_PRINT ) );
	}
	else echo "<script>history.back()</script>";

	if(file_exists( DATA_FILE )){
		$data = json_decode( file_get_contents( DATA_FILE ), true );
		$infoClient = $data['infoclient'];
		$details = $data['details'];
	}

	require '../includes/classLoader.inc.php';
	require '../includes/functions.inc.php';

	date_default_timezone_set('Africa/Lubumbashi');
?>