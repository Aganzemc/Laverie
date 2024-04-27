<?php
	include "includes/functions.inc.php";
	
	if(!isset($_SESSION)) session_start();
	if( !in_array ( $_SESSION['logInfo']['access'], array( "editor", "admin", "caisse" ) ) ) logout();

	$logInfo = $_SESSION['logInfo'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Accueil</title>
	<meta charset="utf-8">
  	<meta http-equiv="x-ua-compatible" content="ie=edge">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" type="text/css" href="libs/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="libs/font-awesome/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="libs/font-awesome/css/font-awesome.min.css">
  	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body style="padding-top: 50px;">
	<div class="jumbotron">
		<div class="container">
			<h1>PRESSING ET LAVERIE <small>HOME</small></h1>
			<p class="pull-right">
				<b><?= (isset($logInfo['name']) ? ucfirst($logInfo['name']) : '')?></b>
			</p>		
		</div>
	</div>
	<?php include 'includes/navbar.inc.php';?>
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-md-offset-0">

				<?php include "templates/carousel_001.php"?>

			</div>
		</div>
	</div>
	<script src="http://localhost/laverie/libs/bootstrap/js/jquery.js"></script>
  	<script src="http://localhost/laverie/libs/bootstrap/js/bootstrap.js"></script>
</body>
</html>