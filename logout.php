<?php
	if(!isset($_SESSION)) session_start();


	if (isset( $_SESSION['logInfo']['id'] ) && isset( $_SESSION['logInfo']['loginKey'] ) ) {

		include "includes/classLoader.inc.php";

		$userInfos = $_SESSION['logInfo'];
		$user_id = $userInfos['id'];
		$login_key = $userInfos['loginKey'];

		$obj_loginManager = new LoginManager();
		$disconnect = $obj_loginManager->updateLogin( $user_id, $login_key );

		if($disconnect)
			logout();
		else
			logout();
	}else {
		logout();
	}

	function logout(){
		session_destroy();
		session_unset();
		header('location:index.php');
	}

	// include "includes/classLoader.inc.php";

	// $obj_loginManager = new LoginManager();

	// echo "<pre>";
	// 	var_dump($obj_loginManager->getLoginAll());
	// echo "<pre>";

?>