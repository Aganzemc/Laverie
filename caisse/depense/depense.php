<!-- index.depense.php -->
<?php
	include "../../includes/functions.inc.php";
	include "../../includes/classLoader.inc.php";

	$obj_depense = new Depense();
	$depenses = $obj_depense->getDepenseAll();
?>
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
		  		<?php include "../../includes/messenger.inc.php";?>
		  		<div class="col-md-12 col-md-offset-0">
					<?php include "navbar.php"?>
					<div class="page-header"> <h1>DEPENSE <small>Effectuees</small></h1> </div>
						<?php if(count($depenses) > 0):?>
							<table class="table table-hover">
								<thead>
									<tr>
										<th>Designation</th>
										<th>Montant</th>
										<th>Date</th>
										<th>Options</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($depenses As $depense):?>
										<tr>
											<td><?= $depense['designation']?></td>
											<td><?= $depense['montant']?> $ </td>
											<td><?= $depense['date_reg']?></td>
											<td>
												<a href="<?= basename($_SERVER['SCRIPT_NAME'])?>?delete=<?= $depense['depense_id']?>" class="btn btn-danger disabled">Delete</a>
											</td>
										</tr>
									<?php endforeach?>
								</tbody>
							</table>
						<?php else: ?>
							<div class="alert alert-info">
								<p>
									Aucun enregistement trouvés!
								</p>
							</div>
						<?php endif ?>
					
		  			</div><!-- End panel panel-primary -->
		  		</div>
		  		<?php 
		  			if (isset($_REQUEST['delete'])) {

						$depense_id = $_REQUEST['delete'];
						$delete = $obj_depense->deleteDepense($depense_id);
						if ($delete) {
							$_SESSION['message'] = "Depense supprimee avec succes";
							$_SESSION['msg_type'] = "success";

						}
						header("location: ".basename($_SERVER['SCRIPT_NAME'])." ");
					}

		  		?>
			</div>
		</div>
	</body>
</html>