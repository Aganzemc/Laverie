<!-- cli.payment.php -->
<?php

	include "../../includes/functions.inc.php";
	include "../../includes/classLoader.inc.php";

	if(!isset($_SESSION)) session_start();
	if(($_SESSION['logInfo']['access'] != "caisse")) logout();

	$obj_caisse = new Caisse();
	$clients = $obj_caisse->getClientAll();

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
		<link rel="stylesheet" type="text/css" href="http://localhost/laverie/libs/bootstrap/css/bootstrap-theme.css">
	  	<link rel="stylesheet" type="text/css" href="http://localhost/laverie/css/main.css">
	</head><!--images/images (7).jpeg-->
	<body>
		<div class="container">
		  		<?php include "header.payment.php";?>
		  	<div class="row">
		  		<?php include "../../includes/messenger.inc.php";?>
		  		<div class="col-md-8 col-md-offset-2">
					<h1>CAISSE <small>Clients</small></h1>
					<?php if (count($clients) > 0 ): ?>
	  					<table class="table table-hover">
	  						<thead>
	  							<tr>
	  								<th>N</th>
	  								<th>Nom</th>
	  								<th>Adresse</th>
	  							</tr>
	  						</thead>
	  						<tbody>
	  							<?php foreach ($clients as $value): ?>
	  								<tr>
	  									<td><?= $i?></td>
	  									<td> <?= $value['nom'] ?> </td>
	  									<td><?= $value['adresse'] ?></td>
	  								</tr>
	  								<?php $i++?>
	  							<?php endforeach ?>
	  						</tbody>
	  					</table>
					<?php else: ?>
						<div class="alert alert-info">
							<p>
								Aucun Enregistrement trouvé!
							</p>
						</div>
					<?php endif ?>
		  		</div>
			</div>
		</div>
	</body>
</html>