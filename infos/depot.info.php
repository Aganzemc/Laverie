<!-- depot.info.php -->
<?php
	$require_file = "require.info.php";
	if (!file_exists( $require_file ) )  header("location:index.php");
	require $require_file;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Depot</title>
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
			<div class="col-md-8 col-md-offset-2">

				<?php $infos_depot = isset($infos_depot) ? $infos_depot : array(); ?>
				<?php if(count($infos_depot) > 0):?>
					<div class="panel panel-default">

						<div class="panel-heading">DEPOT VETEMENT</div>
						<div class="panel-body">
							<p>
								Ont deposes leurs vetements!
							</p>
						</div>

						<table class="table table-hover">
							<tr>
								<th>DATE-DEPOT</th>
								<th>CLIENT</th>
								<th>NOMBRE</th>
								<th>OPTION</th>
							</tr>
							<?php foreach($infos_depot as $row):?>
								<tr>
									<td><?= $row['date_depot']?></td>
									<td><?= $row['nom']?></td>
									<td><?= $row['nombre_hab']?></td>
									<td> <a href="vetement.info.php?record=<?= $row['record_id']?>" class="btn btn-default" >Vetements</a> </td>
								</tr>
							<?php endforeach;?>
						</table>

					</div>
				<?php else:?>
					<div class="alert alert-info">
						<p>
							<span>Auncun enregistrement trouvé! </span>
						</p>
					</div>
				<?php endif;?>
			</div>
		</div>
	</div>
</body>
</html>