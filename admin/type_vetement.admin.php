<?php
	//admin_index.php
	require 'process.admin.php';
	
	if ($_SESSION['logInfo']['access'] != 'admin') logout();
	$types = $obj_admin->getTypeAll();
	
	$select = $connect->query("SELECT * FROM types");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Article</title>
	<meta http-equiv="x-ua-compatible" content="ie=edge">
  	<meta name="description" content="">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" type="text/css" href="http://localhost/laverie/libs/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="http://localhost/laverie/libs/bootstrap/css/bootstrap-theme.css">
  	<link rel="stylesheet" type="text/css" href="../css/main.css">
</head>
<body>
	<?php include 'navbar.admin.php';?>
	<div class="container" style="margin-top:50px;">
		<?php include "../includes/messenger.inc.php" ?>
		<h3 class="page-header">Type de Vetement</h3>
		<div class="row">

			<div class="col-md-8">
				<?php include "type/type_vetement_view.inc.php"; ?>
			</div>

			<div class="col-md-4">
				<?php include "type/type_vetement_edit.inc.php"; ?>
			</div>
		</div>
	</div>
</body>
</html>