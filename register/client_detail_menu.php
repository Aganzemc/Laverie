<!-- client_detail_menu.php -->
<?php
	
	require "register_require.inc.php";

	$obj_suitRegister = new SuitRegister();

	if (isset($_GET['add_info'])) {
		$client_id = $obj_suitRegister->getClientInfo($_GET['add_info']);
		$client_id = $client_id['client_id'];
		
		if(!$client_id) echo "<script>history.back()</script>";
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Client</title>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" type="text/css" href="http://localhost/laverie/libs/bootstrap/css/bootstrap.css">
</head>
<body>
	<div class="container" style="margin-top: 50px;">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">

				<?php if (isset( $_GET['requette'] ) ): ?>

					<?php 
						$requette_id = $_GET['requette'];
						$recordInfo = $obj_suitRegister->getRecordInfo( $requette_id );

						$data = array(
							"last_update" => date("Y-m-d H:i:s", time()),
							"infoclient" =>  $obj_suitRegister->getClient_Record($client_id, $requette_id),
							"details" => $obj_suitRegister->getVetement_type($requette_id)
						);

						$_SESSION['data']['print'] = $data;
					?>

					<?php if ( $recordInfo['recupere'] ): ?>
						<a href="../print/bon.php" class="btn btn-success btn-lg btn-block">Voir Bon</a>
					<?php else: ?>
						<a href="../print/bon.php" class="btn btn-success btn-lg btn-block">Livrair un Bon</a>
					<?php endif ?>
					<br> <br> <br>
					<a href="../print/facture.php" class="btn btn-primary btn-lg btn-block">Voir Facture</a>
					<br> <br> <br>
					<a href="../print/client_vetement.php" class="btn btn-info btn-lg btn-block">Voir Vetement</a>
					<br> <br> <br>

					<div class="btn-group">
						<button class="btn btn-default btn-md" onclick="javascript:window.location = 'index.php';">Terminer l'Operation</button>
					</div>

				<?php endif;?>
			</div>
		</div><!-- End Row -->
	</div><!-- End container -->
	<?php include "navbar.regist.php"; ?>
</body>
</html>