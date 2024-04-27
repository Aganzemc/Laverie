<!-- recuperation.info.php -->
<?php
	$require_file = "require.info.php";
	if (!file_exists( $require_file ) )  header("location:index.php");
	require $require_file;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Info retrait</title>
	<meta charset="utf-8">
  	<meta http-equiv="x-ua-compatible" content="ie=edge">
  	<meta name="description" content="">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" type="text/css" href="../libs/bootstrap/css/bootstrap.css">
</head>
<body>
	<div class="container">
		<?php include 'navbar.info.php';?>
		<div class="row">
			<div class="col-md-8 col-md-offset-2">

				<?php $infos_date_recupereation = isset($infos_date_recupereation) ? $infos_date_recupereation : array(); ?>
				<?php if(count($infos_date_recupereation) > 0 ):?>
					<div class="panel panel-default">

						<div class="panel-heading">PROCHAINE RECUPERATION</div>
						<div class="panel-body">
							<p>
								Passeront recuperer leurs vetements!
							</p>
						</div>

						<table class="table table-hover">
							<tr><th>CLIENT</th><th>DATE-RETRAIT</th><th>VETEMENT</th></tr>
							<?php foreach($infos_date_recupereation AS $row):?>
								<tr>
									<td><?= $row['nom']?></td>
									<td><?= $row['date_recupe']?></td>
									<td><?= $row['nombre_hab']?></td>
								</tr>
							<?php endforeach;?>
						</table>
					</div>
				<?php else: ?>
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