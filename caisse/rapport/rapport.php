<!-- rapport.php -->
<?php

	include "../../includes/functions.inc.php";
	include "../../includes/classLoader.inc.php";

	$cl_caisse = new Caisse2();

	$total_input = $cl_caisse->getPaymentTotal();
	$total_output = $cl_caisse->getDepenseTotal();
	$total_capital = $cl_caisse->getCapitalTotal();

	$depense_month = $cl_caisse->getDepenseMonth();
	$depense_year  = $cl_caisse->getDepenseYear();

	$monthly_input = $cl_caisse->getMonthlyPayment();
	$monthly_output = $cl_caisse->getMonthlyDepense();
	$monthly_capital = $cl_caisse->getMonthlyCapital();
	$monthly = $cl_caisse->getMonthly();

	echo "<pre>";
		// var_dump($monthly_output);
		var_dump($monthly);
	echo "</pre>";

	// $data = array(
		
	// 	"last_update" 	=> date("d-m-Y H:i:s"),
	// 	"input" 		=> $monthly_input,
	// 	"output" 		=> $monthly_output,
	// 	"capital" 		=> $monthly_capital
	// );

	// file_put_contents("inPut_outPut.json", json_encode($data, JSON_PRETTY_PRINT));
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Rapport</title>
		<meta charset="utf-8">
	  	<meta http-equiv="x-ua-compatible" content="ie=edge">
	  	<meta name="description" content="">
	  	<meta name="viewport" content="width=device-width, initial-scale=1">
	  	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="http://localhost/laverie/libs/bootstrap/css/bootstrap.css">
	</head><!--images/images (7).jpeg-->
	<body>
		<div class="container">
			<?php include "navbar.php"?>
		  	<div class="row">
		  		<?php include "../../includes/messenger.inc.php";?>
		  		<div class="col-md-8 col-md-offset-2">
		  			<div class="row justify-content-center">
		  				<div class="col-md-4">
		  					<div class="panel panel-warning text-center">
		  						<div class="panel-heading"><h2 class="panel-title">ENTREES</h2></div>
		  						<div class="panel-body">
		  							<h1 class="text-warning"><?= $total_input?>&nbsp;$</h1>
		  						</div>
		  					</div>
		  					
		  				</div>
		  				<div class="col-md-4">
		  					<div class="panel panel-danger text-center">
		  						<div class="panel-heading"><h2 class="panel-title">SORTIES</h2></div>
		  						<div class="panel-body">
		  							<h1 class="text-danger"><?= $total_output?>&nbsp;$</h1>
		  						</div>
		  					</div>
		  					
		  				</div>
		  				<div class="col-md-4">
		  					<div class="panel panel-success text-center">
		  						<div class="panel-heading"><h2 class="panel-title">CAPITAL</h2></div>
		  						<div class="panel-body">
		  							<h1 class="text-success"><?= $total_capital?>&nbsp;$</h1>
		  						</div>
		  					</div>
		  				</div>
		  			</div>
		  		</div>
		  	</div>
	  		<!-- <br> -->
	  		<hr>
	  		<!-- <br> -->
	  		<div class="row">

		  		<?php if ( count($monthly_capital) > 0): ?>

			  		<div class="col-md-12">
			  			<div class="table-responsive">
			  				<h2>Rapport Mensuel <small>Caisse</small> </h2>
			  				<table class="table table-hover">
			  					<thead style="background-color:#000;color: #f4f4f4;">
			  						<tr>
			  							<th>Year</th>
			  							<th>Month</th>
			  							<th>Entrees</th>
			  							<th>Sorties</th>
			  							<th>Capital</th>
			  							<th>Status</th>
			  						</tr>
			  					</thead>
			  					<tbody>
			  						<?php foreach ($monthly_capital as $value): ?>
				  						<tr >
				  							<td><?= $value['year']?></td>
				  							<td><?= $value['month']?> &nbsp;</td>
				  							<td><?= $value['input']?> &nbsp;$</td>
				  							<td><?= $value['output']?> &nbsp;$</td>
				  							<td ><?= $value['capital']?> &nbsp;$</td>

				  							<td class="alert alert-<?= $value['msg_type']?>">
				  								<?= $value['precise']?>
				  							</td>
				  						</tr >
			  						<?php endforeach ?>
			  					</tbody>
			  				</table>
			  			</div>
			  		</div>
			  		<div style="margin-bottom:1000px;"></div>

			  	<?php endif ?>

	  		</div>
		</div>
	</body>
</html>