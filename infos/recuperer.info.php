<!-- recuperer.info.php -->
<?php
	$require_file = "require.info.php";
	if (!file_exists( $require_file ) )  header("location:index.php");
	require $require_file;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Recuperer</title>
	<meta charset="utf-8">
  	<meta http-equiv="x-ua-compatible" content="ie=edge">
  	<meta name="description" content="">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" type="text/css" href="http://localhost/laverie/libs/bootstrap/css/bootstrap.css">
</head>
<body>
	<div class="container">
		<?php include 'navbar.info.php';?>
		<div class="row">
			<div class="col-md-12 col-md-offset-0">

				<?php $infos_recuperer = isset($infos_recuperer) ? $infos_recuperer : array(); ?>
				<?php if( count($infos_recuperer) > 0 ):?>

					<div class="panel panel-default">
						<div class="panel-heading">VETEMENT RECUPERES</div>
						<div class="panel-body">
							<p>
								Vetements Recuperé(s)
							</p>
						</div>

						<table class="table table-hover">
							<tr>
								<th>DATE-DEPOT</th>
								<th>DATE-RETRAIT</th>
								<th>CLIENT</th>
								<th>VETEMENT</th>
							</tr>
							<?php foreach( $infos_recuperer as $row ):?>
								<tr>
									<td><?= $row['date_depot']?></td>
									<td><?= $row['date_recupe']?></td>
									<td><?= $row['nom']?></td>
									<td><?= $row['nombre_hab']?></td>
								</tr>
							<?php endforeach;?>
						</table>
					</div>

				<?php else:?>
					<div class="alert alert-info">
						<p>
							<span>Auncun enregisterment trouvé! </span>
						</p>
					</div>
				<?php endif;?>
			</div>
		</div>
	</div>
</body>
</html>