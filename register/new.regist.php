<!-- new.regist.php -->
<?php
	require 'register_require.inc.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Regist</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="http://localhost/laverie/libs/bootstrap/css/bootstrap.css">
</head>
<!-- url('images/logos/04.jpg') -->
<body style="background:rgba(0,0,0,0);padding-top: 30px">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-info justify-content-md-center align-items-center vh-100">

					<div class="panel-heading text-center"><h2 class="text-white">NOUVEAU CLIENT</h2></div>
					<div class="panel-body">
						<form method="POST" action="<?= basename($_SERVER['SCRIPT_NAME']);?>" enctype="multipart/form-data" class="form-block" role="form">

							<?php include "../includes/messenger.inc.php";?>

							<div class="form-group">
								<label for="text" class="sr-only">NOM CLIENT</label>
								<input type="text" name="nom" placeholder="Nom du client" autocomplete="on" required="required" class="form-control">
							</div>
							<div class="form-group">
								<label for="text" class="sr-only">PRENOM CLIENT</label>
								<input type="text" name="prenom" placeholder="Prenom du client" autocomplete="on" required="required" class="form-control">
							</div>
							<div class="form-group">
								<label for="text" class="sr-only">ADRESS CLIENT</label>
								<input type="text" name="adresse" placeholder="Adresse Client" autocomplete="on" required="required" class="form-control">
							</div>
							<div class="form-group">
								<input type="date" name="date_nais" min="1970-01-01" max="<?= date('Y-m-d',time());?>" required="required" class="form-control">
							</div>
							<div class="form-group">
								<input type="submit" name="regist" class="btn btn-default btn-md form-control" value="Enregistrer">
							</div>
						</form>
						<?php 
							if (isset($_POST['regist'])) {
								if (!empty($_POST['nom']) && !empty($_POST['prenom'] && !empty($_POST['adresse']) && !empty($_POST['date_nais']))) {

									$obj_suitRegister = new SuitRegister();

									$name = $_POST['nom']." ".$_POST['prenom'];
									$prenom = $_POST['prenom'];
									$adresse = $_POST['adresse'];
									$date_nais = $_POST['date_nais'];

									if(!$obj_suitRegister->clientExist($name)){
										$insert = $obj_suitRegister->insertClient( $name, $prenom, $adresse, $date_nais );
										
										if ($insert) {
											header("location:vetement_regist.php?add_info=".$obj_suitRegister->getClientLastid()." ");
										}else{
											$_SESSION['message'] = '<label>Erreur d Enregistrement!</label>';
											$_SESSION['msg_type'] = 'danger';
											echo "<script>history.back();</script>";
										} 

									}else {

										//thing to getInfo from existing name

										$_SESSION['message'] = '<label>Le client exist deja !</label>';
										$_SESSION['msg_type'] = 'danger';
										echo "<script>history.back();</script>";
									}
								}else {
									$_SESSION['message'] = '<label>veuillez completer toutes les cases!</label>';
									$_SESSION['msg_type'] = 'danger';
									echo "<script>history.back();</script>";
								}
							}
						?>
					</div>

				</div>
			</div><!-- End .col-md-6 col-md-offset-0 col-lg-6 -->
		</div><!-- End row -->
	</div><!-- End container -->
	<?php include "navbar.regist.php"; ?>
</body>
</html>