<!-- config.caisse.php -->
<?php 
	if(!isset($_SESSION)) session_start();

	function getback(){

		echo "<script>
				window.location = 'http://localhost/laverie/index.php';
			</script>";
	}

	if(isset($_SESSION['logInfo'])){

		$logInfo = $_SESSION['logInfo'];
		$config = array();
		
		$config = array(

			"logInfo" => $logInfo,
			"accesses" => array("caisse"),
			"data_file" => "data.json",
			"pages" => array(

				"depense/add.depense.php",
				"depense/depense.php",
				"depense/index.php",
				"payment/aquite.payment.php",
				"payment/client.payment.php",
				"payment/facture.payment.php",
				"payment/facture.payment.php",
				"payment/index.php",
				"payment/non_acquite.payment.php",
				"payment/vetement.payment.php"
			)
		);

		// echo basename($_SERVER['SCRIPT_NAME']);
		$conf_infoLog = $config['logInfo'];

		if (!in_array($conf_infoLog['access'], $config['accesses'])) {
			hard_return();
		}
	}else{
		getback();
	}
?>

