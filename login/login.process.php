<?php
	if (isset($_POST['login'])) {

		date_default_timezone_set('Asia/Jerusalem');

		if(!isset($_SESSION)) session_start();

	    if (!empty($_POST['name']) && !empty($_POST['pw'])) {

	    	include '../includes/classLoader.inc.php';

	      	$name = $_POST['name'];
	      	$pw = $_POST['pw'];
	      	$keepIn = isset($_POST['keepLogIn']) ? $_POST['keepLogIn'] : false;

	      	$login = new Login( $name, $pw, $keepIn );

	      	if($login->login()){
	      		$location = new Access( $_SESSION['logInfo']['access'] );
	      	} else {

	      		$_SESSION['message'] = $login->getError();
		    	$_SESSION['msg_type'] = 'danger';
		    	header('location:login.php');
	      	}
	    }else {

	      	$_SESSION['message'] = 'veuillez completer toutes les cases!';
	      	$_SESSION['msg_type'] = 'warning';
	      	header('location:login.php');
	    }
	}
?>

