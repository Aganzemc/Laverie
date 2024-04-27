<!-- index.php //caisse -->
<?php

	if(!isset($_SESSION)) session_start();
	$config_file = "require.caisse.php";

	include "../includes/classLoader.inc.php";
	$obj_caisse = new Caisse();
	$protocol = $obj_caisse->obj_loginManager;

	$protocol->loginKeyExist();

	if(!file_exists($config_file)){
		echo "<script>history.back()</script>";
	}
	else{

		require $config_file;
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
			<link rel="stylesheet" type="text/css" href="http://localhost/laverie/libs/bootstrap/css/bootstrap-theme.css">
		  	<link rel="stylesheet" type="text/css" href="http://localhost/laverie/css/main.css">
		</head><!--images/images (7).jpeg-->
		<body>
			<div class="jumbotron">
				<div class="container">
					<h1 class="text-center">PRESSING ET LAVERIE <small>CAISSE</small></h1>
				</div>
			</div>
			<div class="container">
				<div class="nav">
					<ul class="breadcrumb">
						<li class="pull-right"><a href="http://localhost/laverie/logout.php"><b>LogOut</b></a></li>
						<li>&nbsp;</li>
					</ul>
				</div>
			  	<div class="row">
			  		<div class="col-md-8 col-md-offset-2">
			  			
			  			<?php include "../includes/messenger.inc.php";?>
						<a href="payment/index.php" class="btn btn-warning btn-lg btn-block">Payment</a>
						<br> <br> <br>
						<a href="depense/index.php" class="btn btn-success btn-lg btn-block">Depense</a>
						<br> <br> <br>
						<a href="rapport/index.php" class="btn btn-info btn-lg btn-block">Rapport</a>
			  		</div>
				</div>
			</div>
		</body>
	</html>
<?php } ?>