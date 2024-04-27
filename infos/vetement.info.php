<!-- vetement.php -->
<?php if(isset($_REQUEST['record'])):?>
	<?php
		$require_file = "require.info.php";
		
		if (!file_exists( $require_file ) )  header("location:index.php");
		require $require_file;

		$infos_vetement = $obj_infoClient->vetement($_REQUEST['record']);

		function getTypeVetement( int $type_id ){

			Global $obj_infoClient;
			return $obj_infoClient->get_vetement_type( $type_id );
		}

		$infoClient = $obj_infoClient->get_client_info( $_REQUEST['record'] );

		$i = 1;
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Vetement</title>
		<meta charset="utf-8">
	  	<meta http-equiv="x-ua-compatible" content="ie=edge">
	  	<meta name="description" content="">
	  	<meta name="viewport" content="width=device-width, initial-scale=1">
	  	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="http://localhost/laverie/libs/bootstrap/css/bootstrap.css">
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					
					<?php $infos_vetement = isset($infos_vetement) ? $infos_vetement : array(); ?>
					<?php if(count($infos_vetement) > 0 ):?>
						<div class="panel panel-default">
						<div class="panel-heading">VETEMENT INFOS</div>
						<div class="panel-body">
							<p>
								Client : <span ><?= $infoClient['nom'] ?></span>
							</p>
						</div>
						<table class="table table-hover">
							<tr>
								<th>No</th>
								<th>TYPE-VETEMENT</th>
								<th>NOMBRE</th>
							</tr>
							<?php foreach($infos_vetement AS $row):?>
								<tr>
									<td><?= $i?></td>
									<td><?= getTypeVetement($row['type_id'])?></td>
									<td><?= $row['vetement_num']?></td>
								</tr>
								<?php $i++?>
							<?php endforeach;?>
						</table>
					<?php else:?>
						<div class="alert alert-danger">
							<p>
								Aucune information Trouvée
							</p>
						</div>
					<?php endif;?>
				</div>
			</div>
		</div>
	</body>
	</html>
<?php endif ?>