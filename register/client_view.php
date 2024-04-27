<!-- client_view.php -->

<?php 
	require "register_require.inc.php";

	$obj_suitRegister = new SuitRegister();

	$clients = $obj_suitRegister->getClientAll();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Clients</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="http://localhost/laverie/libs/bootstrap/css/bootstrap.css">
	
</head>
<!-- url('images/logos/04.jpg') -->
<body style="background:rgba(0,0,0,0);padding-top: 30px">
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<?php include "client_search.inc.php" ?>

				<div class="panel">
					<?php if(count($clients) > 0):?>

						<p> <span class="badge bagde-link"><?= count($clients)?> Clients </span> </p>
						<table class="table table-hover">
							<!-- <caption ></caption> -->
							<thead style="background-color:rgba(0, 0, 0, 1.0);color: #f4f4f4;">
								<tr class="position-sticky-0">
									<th>N°</th>
									<th>Nom</th>
									<th>ADRESSE</th>
									<th>DATE NAISSANCE</th>
									<th>RECORDS</th>
								</tr>
							</thead>
							<tbody>
								
								<?php $i = count($clients);?>
								<?php foreach( $clients as $row ): ?>
									<tr>
										<td><?= $i; ?></td>
										<td><?= $row['nom'];?></td>
										<td><?= $row['adresse']; ?></td>
										<td><?= $row['date_nais']; ?></td>
										<td>
											<a href="vetement_regist.php?add_info=<?= $row['client_id'];?>" class="btn btn-info">Nouveau</a>
											<a href="client_record.php?add_info=<?= $row['client_id'];?>" class="btn btn-primary">Info</a>
										</td>
									</tr>
									<?php $i--; ?>
								<?php endforeach; ?>
							</tbody>
						</table>

					<?php else: ?>

						<div class="alert alert-info">
							<p>
								No clients recorded!
							</p>
						</div>
						
					<?php endif ?>
				</div><!-- End .panel panel-primary -->

			</div><!-- End .col-md-6 col-md-offset-0 col-lg-6 -->
		</div><!-- End row -->
	</div><!-- End container -->
	<?php include "navbar.regist.php"; ?>
	<script type="text/javascript" src="../libs/bootstrap/js/jquery.js"></script>
	<script type="text/javascript" src="../libs/bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$(".launch-modal-unset-item").click(function(){
				$("#modal-unset-item").modal({
					backdrop: 'static'
				});
			});

			$(".launch-modal-personal-info").click(function(){
				$("#modal-unset-personal-info").modal({
					backdrop: 'static'
				});
			});
		});
	</script>
</body>
</html>