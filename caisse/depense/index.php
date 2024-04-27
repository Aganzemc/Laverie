<!-- index.depense.php -->
<?php
	include "../../includes/classLoader.inc.php";

	$obj_depense = new Depense();
	$depense_month = $obj_depense->getDepenseMonth();
	$total_depense = $obj_depense->getDepenseTotal();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Depense</title>
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
				<h1>CAISSE <small>Depense</small></h1>
			</div>
		</div>
		<div class="container">
			<?php include "navbar.php"?>
		  	<div class="row">
		  		<?php include "../../includes/messenger.inc.php";?>
		  		<div class="col-md-8">
		  			<div class="justify-content-center">

		  				<?php if(count($depense_month) > 0): ?>
			  				<table class="table table-hover">
			  					<thead>
			  						<tr>
			  							<th>Year</th>
			  							<th>Month</th>
			  							<th>Montant ($)</th>
			  							<th>Nombre</th>
			  							<!--add detail -->
			  						</tr>
			  					</thead>
			  					<tbody>
		  							<?php foreach ($depense_month as $value): ?>
		  								<tr>
				  							<td><?= $value['year']?></td>
				  							<td><?= $value['month']?></td>
				  							<td><?= $value['sum']?> &nbsp;$</td>
				  							<td><?= $value['times']?></td>
		  								</tr>
		  							<?php endforeach ?>
			  					</tbody>
			  				</table>
			  			<?php else:?>
			  				<div class="alert alert-info">
			  					<p>
			  						Aucun enregistrement trouvés
			  					</p>
			  				</div>
			  			<?php endif ?>

		  			</div>
		  		</div>
		  		<div class="col-md-4">
		  			<div class="panel panel-warning text-center">
		  				<div class="panel-heading"> <h3 class="panel-title">Depense Total</h3> </div>
		  				<div class="panel-body">
		  					<h1><?= $total_depense?> &nbsp;$</h1>
		  				</div>
		  			</div>
		  		</div>
			</div>
		</div>
	</body>
</html>
