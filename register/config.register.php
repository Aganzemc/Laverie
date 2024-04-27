<!-- config.register.php -->
<?php 
	if(!isset($_SESSION)) session_start();

	function hard_logOut(){
		header("location:http://localhost/laverie/index.php");
	}

	if(isset($_SESSION['logInfo'])){

		$logInfo = $_SESSION['logInfo'];
		$configs = array();
		
		$configs = array(

			"logInfo" => array(

				"loginKey" => isset($logInfo['loginKey']) ? $logInfo['loginKey'] : 0,
				"user_id" => isset($logInfo['id']) ? $logInfo['id'] : 0,
				"user_name" => isset($logInfo['id']) ? $logInfo['name'] : "",
				"user_pw" => isset($logInfo['pw']) ? $logInfo['pw'] : false,
				"access" => isset($logInfo['access']) ? $logInfo['access'] : "",
				"lang" => isset($logInfo['lang']) ? $logInfo['lang'] : "en",
				"active" => isset($logInfo['active']) ? $logInfo['active'] : false

			),
			"accesses" => array("editor")
		);

		$conf_infoLog = $configs['logInfo'];

		if (!in_array($conf_infoLog['access'], $configs['accesses'])) {
			hard_logOut();
		}
	}else{
		echo "<script>history.back();</script>";
	}
?>