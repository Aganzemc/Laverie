<!-- vetement.payment.php -->
<?php if(isset($_REQUEST['record'])):?>
	<?php
		include "../../includes/functions.inc.php";
		include "../../includes/classLoader.inc.php";

		$obj_caisse = new Caisse();

		$record_id = $_REQUEST['record'];

		$infoClient = $obj_caisse->getClientRecord($record_id);

		$request = $obj_caisse->getVetementTypeRecord($record_id);

		$sum = $obj_caisse->getSum($record_id);
		$i = 1;

		$pay = $obj_caisse->obj_payment;
		// var_dump($pay->getPaymentLastId());
	?>
	<!DOCTYPE html>
	<html lang="en">
		<head>
			<title>Caisse</title>
			<meta charset="utf-8">
		  	<meta http-equiv="x-ua-compatible" content="ie=edge">
		  	<meta name="description" content="">
		  	<meta name="viewport" content="width=device-width, initial-scale=1">
		  	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
			<link rel="stylesheet" type="text/css" href="http://localhost/laverie/libs/bootstrap/css/bootstrap.css">
			<link rel="stylesheet" type="text/css" href="http://localhost/laverie/libs/bootstrap/css/bootstrap-theme.css">
		  	<link rel="stylesheet" type="text/css" href="http://localhost/laverie/css/main.css">
		</head><!--images/images (7).jpeg-->
		<body>
			<div class="container">
				<?php include "header.payment.php";?>
			  	<div class="row">
			  		<?php include "../../includes/messenger.inc.php";?>
			  		<div class="col-md-8">
						 <h1>CAISSE <small>Payment</small></h1>
		  				<?php if (count($request) > 0): ?>
		  					<p class="hidden">Client : <span><?= $infoClient['nom'] ?></span></p>
		  					<table class="table table-hover hidden">
		  						<thead>
		  							<tr>
		  								<th>N</th>
		  								<th>TYPE_NAME</th>
		  								<th>NOMBRE</th>
		  								<th>PRIX-U ($)</th>
		  								<th>PRIX-T ($)</th>
		  							</tr>
		  						</thead>
		  						<tbody>
		  							<?php foreach ($request as $value): ?>
		  								<tr>
		  									<td><?= $i?></td>
		  									<td><?= $value['type_name']?></td>
		  									<td><?= $value['vetement_num']?> </td>
		  									<td><?= $value['type_price']?> $</td>
		  									<td><?= (float) $value['vetement_num'] * $value['type_price'] ?> $</td>
		  								</tr>
		  								<?php $i++?>
		  							<?php endforeach ?>
		  						</tbody>
		  						<tfoot>
		  							<tr>
		  								<th colspan="4"><span class="">Total Price : <?= $sum ?> $</span></th>
		  								<td><a href="facture_print.php?record=<?= $record_id?>">Imprimer</a></td>
		  							</tr>
		  						</tfoot>
		  					</table>

		  					<div class="panel">
		  						<div class="h3">Pay</div>
		  						<p>Client : <span><?= $infoClient['nom']?></span></p>
		  						<form class="form-block" action="" method="POST">
		  							<div class="form-group">
		  								<label>Montant a Payer : </label>
		  								<input class="form-control" type="text" value="<?= $sum ?> $" step="any" disabled="disabled">
		  								<input type="hidden" value="<?= $sum ?>" name="total" step="any">
		  							</div>
		  							<div class="form-group">
		  								<label>Montant : </label>
		  								<input class="form-control" type="number" value="<?= $sum ?>" name="montant" step="any" autocomplete="off">
		  							</div>
		  							<div class="form-group">
		  								<label>Utilisateur : </label>
		  								<input type="hidden" name="user_id" value="<?= $_SESSION['logInfo']['id'] ?>" required >
		  								<input class="form-control" type="text" name="user_name" value="<?= $_SESSION['logInfo']['name']?>" disabled >
		  							</div>
		  							<div class="form-group">
		  								<label>Date Payment : </label>
		  								<input class="form-control" type="datetime" name="payment_date" value="<?= date('Y-m-d H:i:s',time());?>" max="<?= date('Y-m-d H:i:s',time());?>" autocomplete="off">
		  							</div>
		  							<input class="form-control" type="submit" name="pay" value="Appliquer">
		  						</form>
		  						<?php 
		  							if(isset($_REQUEST['pay'])){

		  								if( !empty( $_REQUEST['montant'] ) && !empty( $_REQUEST['user_id'] ) && !empty( $record_id ) && !empty( $_REQUEST['payment_date'] ) ){

			  								$total 			= (float) $_REQUEST['total'];
			  								$montant 		= (float) trim($_REQUEST['montant']);
			  								$user_id 		= (int) $_REQUEST['user_id'];
			  								$record_id		= (int) $record_id;
			  								$payment_date 	= (string) $_REQUEST['payment_date'];

				  							$insert = $obj_caisse->insertpayment( $montant, $user_id, $record_id, $payment_date );
				  							if($insert){

				  								$_SESSION['message'] = "Enregisterment reussi";
		  										$_SESSION['msg_type'] = "success";

		  										header("location: non_acquite.payment.php");
				  							} else {
				  								$_SESSION['message'] = "Erreur d'insertion !";
		  										$_SESSION['msg_type'] = "danger";

		  										header("location: ".basename($_SERVER['SCRIPT_NAME'])."?record=".$_REQUEST['record']." ");
				  							}

		  								} else {

		  									$_SESSION['message'] = "Veuillez completer toutes les cases";
		  									$_SESSION['msg_type'] = "warning";

		  									header("location: ".basename($_SERVER['SCRIPT_NAME'])."?record=".$_REQUEST['record']." ");
		  								}
		  							}
		  						?>
		  					</div>
		  					
	  					<?php else: ?>
		  					<div class="alert alert-info">
		  						<p>
		  							Aucun enregistrement trouver!
		  						</p>
		  					</div>
		  				<?php endif ?>
			  		</div>
			  		<div class="col-md-4">
			  			<?php include "facture.payment.php";?>
			  		</div>
				</div>
			</div>
		</body>
	</html>
<?php endif ?>