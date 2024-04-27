<!-- index.php //rapport -->
<?php

	include "../../includes/functions.inc.php";
	include "../../includes/classLoader.inc.php";

	$obj_caisse = new Caisse();
	$protocol = $obj_caisse->obj_loginManager;

	// $protocol->loginKeyExist();

	$total = array(
		"input" 	=> $obj_caisse->getPaymentTotal(),
		"output" 	=> $obj_caisse->getDepenseTotal(),
		"capital" 	=> $obj_caisse->getCapitalTotal()
	);

	$monthly = array(
		'input' 	=> $obj_caisse->getMonthlyPayment(),
		'output' 	=> $obj_caisse->getMonthlyDepense(),
		'capital' 	=> $obj_caisse->getMonthlyCapital()
	);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Rapport</title>
		<meta charset="utf-8">
	  	<meta http-equiv="x-ua-compatible" content="ie=edge">
	  	<meta name="description" content="">
	  	<meta name="viewport" content="width=device-width, initial-scale=1">
	  	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="http://localhost/laverie/libs/bootstrap/css/bootstrap.css">
	</head>
	<body>
		<div class="jumbotron">
			<div class="container">
				<h1>RAPPORT <small>Caisse</small></h1>
			</div>
		</div>
		<div class="container">
			<!-- <?//php //include "navbar.php"?> -->
		  	<div class="row">
		  		<?php include "../../includes/messenger.inc.php";?>
		  		<div class="col-md-12 col-md-offset-0">
		  			<?php include "total.php";?>
		  		</div>
		  	</div>
	  		<!-- <br> -->
	  		<hr>
	  		<!-- <br> -->
	  		<div class="row">
	  			<div class="col-md-12">
	  				<?php include "monthly.php";?>
	  			</div>
	  		</div>
		</div>
	</body>
</html>