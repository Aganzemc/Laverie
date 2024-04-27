<!-- add.depense.php -->
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Depense</title>
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
		  	<div class="row">
		  		<div class="col-md-8 col-md-offset-2">
					<?php include "navbar.php"?>
					<div class="page-header"> <h1>DEPENSE <small>Enregistrement</small></h1> </div>
						
						<form method="POST" action="<?= basename($_SERVER['SCRIPT_NAME']);?>" role="form" class="form-block">
		  					
		  					<?php include "../../includes/messenger.inc.php";?>
							<div class="form-group">
								<label class="sr-only">Designation : </label>
								<textarea name="designation" class="form-control"></textarea>
							</div>
							<div class="form-group">
								<label class="sr-only">Montant :</label>
								<input type="number" name="montant" step="any" required="required" placeholder="Montant" autocomplete="off" class="form-control">
							</div>
							<div class="form-group">
								<input type="datetime" name="date_reg" required="required" value="<?= date('Y-m-d H:i:s', time())?>" class="form-control">
							</div>
							<div class="form-group">
								<input type="submit" name="new_depense" value="Enregister" class="btn btn-default form-control">
							</div>
						</form>
						<?php
							if(!isset($_SESSION)) session_start();

							if (isset($_REQUEST['new_depense'])) {

								include "../../includes/functions.inc.php";
								include "../../includes/classLoader.inc.php";

								$obj_depense = new Depense();
								
								if(!empty($_REQUEST['designation']) && !empty($_REQUEST['montant']) && !empty($_REQUEST['date_reg'])){

									$insert = $obj_depense->insertDepense($_REQUEST['designation'], $_SESSION['logInfo']['id'], $_REQUEST['montant'], $_REQUEST['date_reg']);
									if($insert){
										$_SESSION['message'] = "Depense enregistrée";
										$_SESSION['msg_type'] = "success";
									}else{
										$_SESSION['message'] = "Erreur d\'enregistrement essayer plutard!";
										$_SESSION['msg_type'] = "warning";	
									}
								}else{
									$_SESSION['message'] = "Veuillez completer toutes les cases!";
									$_SESSION['msg_type'] = "warning";	
								}
								header("location: ".basename($_SERVER['SCRIPT_NAME'])." ");
							}
						?>
		  			</div><!-- End panel panel-primary -->
		  		</div>
			</div>
		</div>
	</body>
</html>