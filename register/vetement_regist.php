<!-- vetement_regist.php -->
<?php if(isset($_GET['add_info'])): ?>

	<?php
		require "register_require.inc.php";
		
		if(!isset($_SESSION)) session_start();

		$obj_SuitRegister = new SuitRegister();

		$types = $obj_SuitRegister->getTypeEnabled(true);

		$infoClient = $obj_SuitRegister->getClientInfo($_GET['add_info']);
		if (!$infoClient) logout();

		$row = $infoClient;

		$client_id = $infoClient['client_id'];

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
				<div class="col-md-8 col-md-offset-2">
					<div class="panel panel-default">
						<div class="panel-heading"><h5>ENREGISTREMENT DE VETEMENTS</h5></div>
						<div class="panel-body">

							<?php include "../includes/messenger.inc.php"?>

							<form method="POST" action="#" class="form-block" role="form">
								<div class="form-group">
									<label>Client : </label>
									<input type="text" readonly="readonly" class="form-control" value="<?= $infoClient['nom'];?>">
								</div>
								<input type="hidden" name="client_id" value="<?= $infoClient['client_id']?>">
								<hr>
								<div class="form-group">
									<input type="number" min="1" max="20" name="hab" required="required" autocomplete="off" placeholder="Nombre d'habits " class="form-control">
								</div>
								
								<?php if( count( $types ) > 0 ): ?>

									<?php foreach ( $types As $row ): ?>

										<label><?=strtoupper($row['type_name'])?>&nbsp;:<br>
											<input type="hidden" name="type_id[]" autocomplete="off" value="<?=$row['type_id']?>">
											<input type="number" min="0" name="tissu_num[]" value="0" class="form-control">
										</label>

									<?php endforeach ?>

								<?php endif ?>
								<hr>
								<div class="form-group">
									<label>Depot :</label>
									<input type="date" value="<?= date('Y-m-d',time()) ;?>" required="required" name="depot" placeholder="Date du depot " class="form-control">
								</div>
								<div class="form-group">
									<label>Remise :</label>
									<input type="date" value="<?= date('Y-m-d',time()+172800);?>" required="required" name="recupere" placeholder="Date de recuperation " class="form-control">
								</div>
								<div class="form-group">
									<input type="submit" name="info_client_sbm" class="btn btn-default" value="Appliquer">
								</div>
							</form>
							<?php 
								if (isset($_POST['info_client_sbm'])) {
			
									if (!empty($_POST['hab']) && !empty($_POST['depot']) && !empty($_POST['recupere'])) {

										$client_id 		= $_POST['client_id'];
										$hab 			= $_POST['hab'];
										$user_id 	= $_SESSION['logInfo']['id'];
										$depot 			= $_POST['depot'];
										$recupe 		= $_POST['recupere'];
										$sum = 0;

										for ($i = 0;$i < count($_POST['tissu_num']);$i++){
											$sum += $_POST['tissu_num'][$i];
										}

										if ($hab == $sum) {

											$insert_record = $obj_SuitRegister->insertRecord($client_id, $user_id, $hab, $depot, $recupe);

											if ($insert_record) {

												$record_id = $obj_SuitRegister->getRecordLastId();

												for ($i = 0;$i < count($_POST['tissu_num']);$i++){

													$type_id  		= (int) $_POST['type_id'][$i];
													$vetement_num 		= (int) $_POST['tissu_num'][$i];
													
													if(empty($vetement_num)) continue;

													$insert_vetement = $obj_SuitRegister->insertVetement($record_id, $type_id, $vetement_num);
												}

												if ($insert_vetement) {
													header("location: client_record.php?add_info=".$infoClient['client_id']." ");
												}else {
													$_SESSION['message'] = '<label>Erreur d Enregistrement!</label>';
													$_SESSION['msg_type'] = 'danger';

													echo "<script>history.back();</script>";
												}
											}else{
												$_SESSION['message'] = '<label>Erreur d Enregistrement!</label>';
												$_SESSION['msg_type'] = 'danger';
												echo "<script>history.back();</script>";
											} 
										}else{
											$_SESSION['message'] = '<label>Le nombre de vetement ne correspond pas!</label>';
											$_SESSION['msg_type'] = 'warning';
											echo "<script>history.back();</script>";
										}
									}else {
										$_SESSION['message'] = '<label>veuillez completer toutes les cases!</label>';
										$_SESSION['msg_type'] = 'danger';
										echo "<script>history.back();</script>";
									}
								}
							?>
						</div><!-- End panel body -->
						<div class="panel-footer">
							<div class="btn-group text-center">
								<button  class="btn btn-default btn-xm" onclick="javascript:history.back()">Retour</button>
							</div>
						</div>
					</div><!-- End panel -->
				</div><!-- End col-md-4 col-md-offset-0-->
			</div><!-- End Row -->
		</div><!-- End container -->
		<!--<?//php //include "navbar.regist.php"; ?>-->
	</body>
	</html>
<?php endif ?>