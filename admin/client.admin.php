<!-- client.admin.php -->
<!DOCTYPE html>
<html>
<head>
	<title>Admin InfoClient</title>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
  	<meta name="description" content="">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" type="text/css" href="http://localhost/laverie/libs/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="http://localhost/laverie/libs/bootstrap/css/bootstrap-theme.css">
  	<link rel="stylesheet" type="text/css" href="../css/main.css">
</head>
<body bgcolor="black">
	<?php include 'navbar.admin.php';?>

	<div class="container" style="margin-top:60px;">
		<?php include "../includes/messenger.inc.php"; ?>
		<div class="row">
			<div class="col-md-12">
				<iframe src="http://localhost/laverie/infos/index.php" width="100%" height="500"></iframe>
			</div><!-- End col-md-12 po1 -->
		</div><!-- End div row -->
	</div><!-- End div container -->
</body>
</html>