<?php
	if(!isset($_SESSION)) session_start();
	include "../includes/connect_db.inc.php";
	include "../includes/functions.inc.php";

	if ($_SESSION['logInfo']['access'] != 'admin')  logout();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Index</title>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
  	<meta name="description" content="">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" type="text/css" href="../libs/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../libs/bootstrap/css/bootstrap-theme.css">
  	<link rel="stylesheet" type="text/css" href="../css/main.css">
</head>
<body>
	<?php include "navbar.admin.php"; ?>

	<div class="jumbotron" style="margin-top:50px; height: 100%;">
		<div class="container">
			<h5>Espace <b>Administration</b></h5>
			<h1 class="text-center">PRESSING ET LAVERIE</h1>
		</div>
	</div>
	<div class="container">
		<?php include "../includes/messenger.inc.php"; ?>
	</div><!-- End div container -->
</body>
</html>