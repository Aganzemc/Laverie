<!-- facture.php -->
<?php if(file_exists("print_require.inc.php") ): ?>
	<?php require "print_require.inc.php" ;
		$ttg = 0;
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Facture</title>
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
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
							<kbd>Facture</kbd>
							<blockquote>
								<p class="lean">
									Client : <b><?= $infoClient['nom']?></b> <br>
									Vetement(s) : <b><?= $infoClient['nombre_hab']?></b> <br>
									Depot : <b><?= $infoClient['date_depot']?></b> <br>
									Remise : <b><?= $infoClient['date_recupe']?></b>.<br><br>
									<small><cite>Merci de nous avoir choisi!</cite></small>
								</p>
							</blockquote>
							<?php if(count($details) > 0 ):?>
								<p class="lean">Details </p>
								<table class="table table-hover">
									<thead>
										<tr style="background-color: #555;color: #f4f4f4;">
											<th>Type Tissu</th><th>Nombres</th><th>P.U</th><th>P.T</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($details as $detail ):?>
											<tr>
												<td><?= $detail['type_name'];?></td>
												<td><?= $detail['vetement_num'];?></td>
												<td><?= $detail['type_price'];?>&nbsp;$</td>
												<td><?= get_mult(array($detail['type_price'], $detail['vetement_num']));?>&nbsp;$</td>
											</tr>
											<?php $ttg += get_mult(array($detail['type_price'], $detail['vetement_num'])); ?>
										<?php endforeach;?>
									</tbody>
									<tfoot>
										<tr style="background-color: #555;color: #f4f4f4;">
											<?php if (isset($data['payed'])): ?>
												<td colspan="2">
													<b class="pull-left">Total payé : <?= $data['payed']; ?>&nbsp;$</b>
												</td>
												<td colspan="2">
													<b class="pull-right">Total à payer : <?= $ttg; ?>&nbsp;$</b>
												</td>
											<?php else: ?>
												<td colspan="4">
													<b class="pull-right">Total à payer : <?= $ttg; ?>&nbsp;$</b>
												</td>
											<?php endif ?>
										</tr>
									</tfoot>
								</table>
							<?php endif;?>
							<small class="pull-right">
								<p>Fait a Bukavu <?= date('d-m-y H:i',time())?></p>
							</small>
						</div>
					</div>
				</div><!-- End col-md-offset-3 col-md-4 -->
			</div><!-- End row -->
		</div><!-- End container -->
	</body>
	</html>
<?php endif ?>