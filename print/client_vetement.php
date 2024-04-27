<!-- client_vetement -->
<?php if(file_exists("print_require.inc.php") ): ?>
	<?php require "print_require.inc.php" ; ?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Bon</title>
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="http://localhost/laverie/libs/bootstrap/css/bootstrap.css">
		<style type="text/css">
			body {
				margin: 0px;
				padding-top:50px;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-offset-3 col-md-6">
					<div class="panel panel-default">
						<div class="panel-heading"><h2 class="panel-title">Info du Depot</h2></div>
						<div class="panel-body">
							<p> Client  : <span><b><?= $infoClient['nom']?></b></span> </p>
							<p> Depot   : <span><b><?= $infoClient['date_depot']?></b></span> </p>
							<p> Retrait : <span><b><?= $infoClient['date_recupe']?></b></span> </p>
							<br>
							<p> Nombre  : <?= ($infoClient['nombre_hab'] > 1) ? "{$infoClient['nombre_hab']} Vetements" : "{$infoClient['nombre_hab']} Vetement"; ?></p>
							<hr>
							<?php if(count($details) > 0):?>
								<p class="lean">Details </p>
								<table class="table table-hover">
									<thead>
										<tr class="bg-default">
											<th>Type Tissu</th><th>Nombres</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($details as $detail):?>
											<tr>
												<td><?= $detail['type_name'];?></td>
												<td><?= $detail['vetement_num'];?></td>
											</tr>
										<?php endforeach;?>
									</tbody>
								</table>
							<?php endif;?>
						</div>
				</div><!-- End col-md-offset-3 col-md-4 -->
			</div><!-- End row -->
		</div><!-- End container -->
	</body>
	</html>
<?php endif ?>