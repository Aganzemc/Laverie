<!-- infos.php //Information -->
<?php

	include "../includes/connect_db.inc.php";
	include "../includes/functions.inc.php";
	include "../includes/classLoader.inc.php";

	$obj_info = new InfoClient();

	$select = $connect->query("

		SELECT * 
		FROM 
			clients,
			gestion_client 
		WHERE 
			clients.client_id = gestion_client.client_id AND 
			gestion_client.recupere = 0 
		ORDER BY gestion_client.date_recupe

	");

	$select1 = $connect->query("

		SELECT * 
		FROM 
			clients,
			gestion_client 
		WHERE 
			clients.client_id = gestion_client.client_id AND 
			gestion_client.recupere = 0 
		ORDER BY gestion_client.date_depot
	");

	$select2 = $connect->query("

		SELECT * 
		FROM 
			clients,
			gestion_client 
		WHERE 
			clients.client_id = gestion_client.client_id AND 
			gestion_client.recupere = 1 
		ORDER BY gestion_client.date_depot
	");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Requette</title>
	<meta charset="utf-8">
  	<meta http-equiv="x-ua-compatible" content="ie=edge">
  	<meta name="description" content="">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" type="text/css" href="../libs/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../libs/bootstrap/css/bootstrap-theme.css">
  	<link rel="stylesheet" type="text/css" href="../css/main.css">
  	<link rel="stylesheet" type="text/css" href="../libs/js/jquery-ui.min.css">
</head>
<body>
	<?php include '../header.php';?>
	<div class="container" style="padding-top: 50px;">
		<div class="navbar">
			<ul class="breadcrumb">
				<li><a href="date_depot.php">Recuperation</a> </li>
				<li><a href="date_recuperation.php">Depot par une Date</a></li>
				<li><a href="Recuperer.php">Recuperé</a></li>
			</ul>
		</div>
		<div id="tabs" class="">
			<ul>
				<li><a href="#tabs-1">Date Recuperation</a></li>
				<li><a href="#tabs-2">Date Depot</a></li>
				<li><a href="#tabs-3">Recuperer</a></li>
			</ul>
			<div id="tabs-1">
				<h1>Date de recuperation</h1>
				<?php if(mysqli_num_rows($select)>=1):?>
					<table class="table table-hover">
						<tr><th>Recuperation</th><th>Client</th><th>Vetement</th></tr>
						<?php while($row=mysqli_fetch_array($select)):?>
							<tr>
								<td><?= $row['date_recupe']?></td>
								<td><?= $row['nom'].' '.$row['prenom']?></td>
								<td><?= $row['nombre_hab']?></td>
							</tr>
						<?php endwhile;?>
					</table>
				<?php endif;?>
			</div>
			<div id="tabs-2">
				<h1>Depot par une date</h1>
				<?php if(mysqli_num_rows($select1)>=1):?>
					<table class="table table-hover">
						<tr><th>Depot</th><th>Client</th><th>Vetement</th></tr>
						<?php while($row=mysqli_fetch_array($select1)):?>
							<tr>
								<td><?= $row['date_depot']?></td>
								<td><?= $row['nom'].' '.$row['prenom']?></td>
								<td><?= $row['nombre_hab']?></td>
							</tr>
						<?php endwhile;?>
					</table>
				<?php endif;?>
				
			</div>
			<div id="tabs-3">
				<h1>Depot par une date</h1>
				<?php if(mysqli_num_rows($select2) >= 1):?>
					<table class="table table-hover">
						<tr><th>Depot</th><th>Client</th><th>Vetement</th></tr>
						<?php while($row=mysqli_fetch_array( $select2 )):?>
							<tr>
								<td><?= $row['date_depot']?></td>
								<td><?= $row['nom'].' '.$row['prenom']?></td>
								<td><?= $row['nombre_hab']?></td>
							</tr>
						<?php endwhile;?>
					</table>
				<?php endif;?>
				
			</div>
		</div>
	</div>
	<script src="../libs/bootstrap/js/jquery.js"></script>
	<script src="../libs/bootstrap/js/bootstrap.js"></script>
	<script src="../libs/js/jquery-2.2.0.min.js"></script>
	<script src="../libs/js/jquery-ui.min.js"></script>
	<script type="text/javascript" >
		$(document). ready(function(){
			$(".table").hide();
			$(".table").slideDown(2000);
			$(function(){
				$("#tabs").tabs();
			});
		});
	</script>
</body>
</html>