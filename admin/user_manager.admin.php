<!-- user_manager.admin.php -->
<?php
	require 'process.admin.php';
	if ($_SESSION['logInfo']['access'] != 'admin')  logout();

	$users = $obj_admin->getUserAll();
	$user_online = $obj_admin->getOnlineUser( count( $users ) );
	$user_offline = $obj_admin->getOfflineUser(1);

	// var_dump($user_offline);
?>
<!DOCTYPE html>
<html>
<head>
	<title>User Manager</title>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
  	<meta name="description" content="">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" type="text/css" href="http://localhost/laverie/libs/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="http://localhost/laverie/libs/bootstrap/css/bootstrap-theme.css">
  	<link rel="stylesheet" type="text/css" href="../css/main.css">
</head>
<body>
	<?php include 'navbar.admin.php';?>

	<div class="container" style="margin-top:50px;">
		<?php include "../includes/messenger.inc.php"; ?>
		<h3 class="page-header">UTILISATEURS</h3>
		<div class="row">
			<div class="col-md-8">
				<div class="row">

					<div class="col-md-12">
						<?php include "user/user_info_view.inc.php"; ?>
					</div>

					<div class="col-md-12">
						<?php include "user/user_online_view.inc.php";?>
						<hr>
						<?php include "user/user_offline_view.inc.php";?>
					 </div>

				</div>
			</div><!-- End col-md-12 po1 -->
			<div class="col-md-4">
				<?php include "user/user_info_edit_view.inc.php"; ?>
			</div><!-- End col-md-12 po2 -->
		</div><!-- End div row -->
	</div><!-- End div container -->
</body>
</html>