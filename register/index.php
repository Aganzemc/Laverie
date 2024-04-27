<!-- index.php -->
<?php 
	if(!isset($_SESSION)) session_start();
	$config_file = "config.register.php";

	if (!file_exists($config_file)) {
		echo "<script>history.back()</script>";
	}
	else {
		include $config_file;

?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Regist</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="http://localhost/laverie/libs/bootstrap/css/bootstrap.css">
	</head>
	<body>
		<div class="jumbotron">
			<div class="container">
				<h1>PRESSING ET LAVERIE <small>ENREGISTREMENT</small></h1>
				<p class="pull-right">
					<b><?= (isset($logInfo['name']) ? ucfirst($logInfo['name']) : '')?></b>
				</p>	
			</div>
		</div>
		<div class="container">
			<div class="nav">
				<ul class="breadcrumb">
					<!-- <li><a href="../home.php">Accueil</a></li> -->
				</ul>
				
			</div>
			<div class="row text-center">
				<div class="col-md-6 col-md-offset-3">
					<a href="new.regist.php" class="btn btn-info btn-lg btn-block">Nouveau Client</a>
					<br> <br> <br>
					<a href="client_view.php" class="btn btn-success btn-lg btn-block">Client Existant</a>
				</div>
			</div><!-- End row -->
			<?php include "navbar.regist.php";?>
		</div><!-- End container -->
	</body>
	</html>
<?php } ?>