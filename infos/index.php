<!-- index.php -->
<?php
	if(!isset($_SESSION)) session_start();

	$require_file = "require.info.php";
	
	if (!file_exists( $require_file ) )  header("location:http://localhost/laverie/index.php");
	require $require_file;

	$clients = $obj_infoClient->getCount('clients');
	$records = $obj_infoClient->getCount('records');
	$types = $obj_infoClient->getCount('types');
	$vetements = $obj_infoClient->getCount('vetements');
	// echo "<pre>";
	// 	var_dump($clients);
	// echo "</pre>";
?>

<!DOCTYPE html>
<html>
<head>
	<title>INFO</title>
	<meta charset="utf-8">
  	<meta http-equiv="x-ua-compatible" content="ie=edge">
  	<meta name="description" content="">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" type="text/css" href="http://localhost/laverie/libs/bootstrap/css/bootstrap.css">
</head>
<body>
	<div class="jumbotron">
		<div class="container">
			<h1>PRESSING ET LAVERIE <small>INFORMATIONS</small></h1>
		</div>
	</div>
	<div class="container">
		<?php include 'navbar.info.php';?>
		<div class="row">

			<div class="row">
				<div class="col-md-12 col-md-offset-0">
					<div class="row">
						<div class="col-md-3">
							<div class="panel panel-default">
								<div class="panel-heading"><h2 class="panel-title" id="title">Clients</h2></div>
								<div class="panel-body" id="body">
									<h1 id="content"><?= $clients?></h1>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="panel panel-default">
								<div class="panel-heading"><h2 class="panel-title" id="title">Depot</h2></div>
								<div class="panel-body" id="body">
									<h1 id="content"><?= $records?></h1>
								</div>
							</div> 
						</div>
						<div class="col-md-3">
							<div class="panel panel-default">
								<div class="panel-heading"><h2 class="panel-title" id="title">Vetements Traités</h2></div>
								<div class="panel-body" id="body">
									<h1 id="content"><?= $vetements?></h1>
								</div>
							</div> 
						</div>
						<div class="col-md-3">
							<div class="panel panel-default">
								<div class="panel-heading"><h2 class="panel-title" id="title">Type de vetement</h2></div>
								<div class="panel-body" id="body">
									<h1 id="content"><?= $types?></h1>
								</div>
							</div> 
						</div>
						<style type="text/css">
							#body {
								background: #333;
								color: #f4f4f4;
								text-align: center;
							}
							#title {
								font-variant: small-caps;
							}
							#content {
								font-size: 5em;
								font-weight: bolder;
								text-decoration: underline 10px solid #f4f4f4;
							}
						</style>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="http://localhost/laverie/libs/bootstrap/js/jquery.js"></script>
  	<script src="http://localhost/laverie/libs/bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript">
		var page = null;
		function getThisPage(link){
			page = link;

			// window.location = page;
		}
		$(document).ready(function(){

			// alert(page);
		});
	</script>
</body>
</html>