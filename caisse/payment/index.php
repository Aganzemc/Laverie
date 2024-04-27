<!-- index.payment.php -->
<?php

	include "../../includes/functions.inc.php";
	include "../../includes/classLoader.inc.php";

	$obj_caisse = new Caisse();
	$records = $obj_caisse->getRecordRecupere(0);

	$protocol = $obj_caisse->obj_loginManager;

	// $protocol->loginKeyExist();

	function getClient($record_id){
		global $obj_caisse;
		return $obj_caisse->getClientRecord($record_id);
	}

	$i = 1;
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Caisse</title>
		<meta charset="utf-8">
	  	<meta http-equiv="x-ua-compatible" content="ie=edge">
	  	<meta name="description" content="">
	  	<meta name="viewport" content="width=device-width, initial-scale=1">
	  	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="http://localhost/laverie/libs/bootstrap/css/bootstrap.css">
	</head><!--images/images (7).jpeg-->
	<body>
		<div class="jumbotron">
			<div class="container">
				<h1>CAISSE <small>Payment Facture</small></h1>
			</div>
		</div>
		<div class="container">
		  	<?php include "header.payment.php";?>
		  	<div class="row">
		  		<?php include "../../includes/messenger.inc.php";?>
		  		<div class="col-md-8 col-md-offset-2">
		  			<?php 
		  				require "../config.caisse.php";
		  			?>
		  		</div>
			</div>
		</div>
	</body>
</html>