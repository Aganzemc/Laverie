<!-- index.payment.php -->
<?php

	include "../../includes/functions.inc.php";
	include "../../includes/classLoader.inc.php";

	$obj_caisse = new Caisse();
	$records = $obj_caisse->getRecordRecupere(0);

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
		<div class="container">
			<?php include "header.payment.php";?>
		  	<div class="row">
		  		<?php include "../../includes/messenger.inc.php";?>
		  		<div class="col-md-8 col-md-offset-2">
					<h1>CAISSE <small>Non Acquités</small></h1>
	  				<?php if (count($records) > 0): ?>
	  					<table class="table table-hover">
	  						<thead>
	  							<tr>
	  								<th>N</th>
	  								<th>Client</th>
	  								<th>Vetement(s)</th>
	  								<th>Option</th>
	  							</tr>
	  						</thead>
	  						<tbody>
	  							<?php foreach ($records as $value): ?>
	  								<tr>
	  									<td><?= $i?></td>
	  									<td>
	  										<?php 
	  											$data = getClient($value['record_id']);
	  											echo $data['nom'];
	  										?>
	  											
	  									</td>
	  									<td><?= $value['nombre_hab']?></td>
	  									<td><a href="vetement.payment.php?record=<?=$value['record_id']?>">Payer</a></td>
	  								</tr>
	  								<?php $i++?>
	  							<?php endforeach ?>
	  						</tbody>
	  					</table>
  					<?php else: ?>
	  					<div class="alert alert-info">
	  						<p>
	  							Aucun enregistrement trouver!
	  						</p>
	  					</div>
	  				<?php endif ?>
		  		</div>
			</div>
		</div>
	</body>
</html>