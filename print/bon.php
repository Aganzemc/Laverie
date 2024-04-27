<!-- bon.php -->
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
				padding-top:100px;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-offset-3 col-md-6">
					<div class="panel panel-primary">
						<div class="panel-body">
							<h2 style="font-variant: small-caps;" class="text-center">PRESSING ET LAVERIE</h2>
							<kbd>Bon de reception</kbd>
							<blockquote>
								<p class="lean">
									Nous admettons d'avoir recu <b><?= $infoClient['nombre_hab']?></b>  vetement(s) du Monsieur/Madame <b><?= $infoClient['nom']?></b> En date du <b><?= $infoClient['date_depot']?></b> et qui les recevera en retour a la date du <b><?= $infoClient['date_recupe']?></b> .
									<small><cite>Merci de nous avoir choisi!</cite></small>
								</p>
							</blockquote>
							<?php if(count($details) > 0):?>
								<p class="lean">Details </p>
								<table class="table table-hover">
									<thead>
										<tr style="background-color: #555;color: #f4f4f4;">
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
							<small class="pull-right">
								<p>Fait a Bukavu <?= date('d-m-y h:i',time())?></p>
							</small>
						</div>
				</div><!-- End col-md-offset-3 col-md-4 -->
			</div><!-- End row -->
		</div><!-- End container -->
	</body>
	</html>
<?php endif ?>

