<!-- facture_print.php -->
<?php if (isset( $_GET['record'] ) ) : ?>
	<?php
		if(!isset( $_SESSION ) ) session_start();

		require '../../includes/classLoader.inc.php';

		$obj_caisse = new Caisse();

		$requette_id = $_GET['record'];

		$client_id = $obj_caisse->getClientRecord($requette_id);
		$client_id = $client_id['client_id'];

		$data = array(

			"last_update"	=> date("Y-m-d H:i:s", time()),
			"infoclient" 	=>  $obj_caisse->getClient_Record($client_id, $requette_id),
			"details" 		=> $obj_caisse->getVetementTypeRecord($requette_id),
			"toPay" 		=> $obj_caisse->getSum($requette_id),
			"payed" 		=> 0.00
		);

		$_SESSION['data']['print'] = $data;

		if(file_exists( "../../print/facture.php") && isset($_SESSION['data']['print'])) header("location: ../../print/facture.php");
		else echo "<script>history.back()</script>";
	?>
<?php endif ?>