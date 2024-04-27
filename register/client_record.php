<!-- client_record.php -->
<?php if (isset($_GET['add_info'])):?>
	<?php
		require "register_require.inc.php";

		$obj_suitRegister = new SuitRegister();

		$infoClient = $obj_suitRegister->getClientInfo($_GET['add_info']);
		$client_id = $infoClient['client_id'];
		$record = $obj_suitRegister->getClientRecord($client_id);

		if(!$infoClient) logout();
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Client</title>
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="http://localhost/laverie/libs/bootstrap/css/bootstrap.css">
	</head>
	<body>
		<div class="container" style="padding-top: 50px;">
			<div class="row">
				<div class="col-md-10 col-md-offset-1">

					<?php if(count($record) >0 ):?>
						<div class="panel panel-default">
							<div class="panel-heading"><h3 class="panel-title">ENREGISTREMENTS CLIENT</h3></div>
							<div class="panel-body">
								<p> <span>Client : <b><?= $infoClient['nom']?></b></span> </p>
							</div>
							<table class="table table-hover">
								<tr>
									<th>N°</th>
									<th>VETEMENT</th>
									<th>ENTRER</th>
									<th>SORTIE</th>
									<th>RETIRÉ</th>
									<th>DETAILS</th>
								</tr>
								<?php $i = 1;?>

								<?php foreach($record as $row):?>
									<tr>
										<td><?= $i;?></td>
										<td><?= ($row['nombre_hab']);?></td>
										<td><?= $row['date_depot'];?></td>
										<td><?= $row['date_recupe'];?></td>
										<td>
											<?= ($row['recupere']==1) ? "OUI" : "Non"; ?>
										</td>
										<td>
											<a href="client_detail_menu.php?add_info=<?= $client_id;?>&requette=<?= $row['record_id'];?>" class="btn btn-default">Plus</a>
										</td>
									</tr>
									<?php $i++;?>
								<?php endforeach;?>
							</table>
						</div>
					<?php else:?>

						<div class="alert alert-info">
							<p>Aucun enregisterment trouvé!</p>
						</div>

					<?php endif;?>

				</div><!-- End col- -->
			</div><!-- End Row -->
		</div><!-- End container -->
		<?php include "navbar.regist.php"; ?>
	</body>
	</html>
<?php endif ?>