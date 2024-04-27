<!-- require.info.php -->
<?php 
	if(!isset( $_SESSION ) ) session_start();

	if(!isset($_SESSION['logInfo']['loginKey'])) header("location:logout.php");

	include "../includes/functions.inc.php";
	include "../includes/classLoader.inc.php";

	$obj_infoClient = new InfoClient();

	function getUserInfo( $user_id, $element = "name"){
		Global $obj_infoClient;
		rtrim($element);
		$result = $obj_infoClient->getUserInfo( $user_id );

		return $result[$element];
	}

	$infos = array(

		"last_update" => date("Y_m_d H:i:s"),
		"infos" => array(

			"depot" => (array) $obj_infoClient->depot(),
			"date_recuperation" => $obj_infoClient->date_recuperation(),
			"infos_recuperer" => $obj_infoClient->recuperer(),
			"agent" => $obj_infoClient->getAgentByDate()
		)
	);

	$infos_file = "infoclient.info.json";
	define("INFOS_FILE_JSON", $infos_file);

	file_put_contents($infos_file, json_encode($infos, JSON_PRETTY_PRINT));

	$infos_json = array();
	if(file_exists($infos_file)){

		$infos_json = json_decode(file_get_contents($infos_file), true);

		$infos_depot = $infos_json['infos']['depot'];
		$infos_date_recupereation = $infos_json['infos']['date_recuperation'];

		$infos_recuperer = $infos_json['infos']['infos_recuperer'];
		$infos_agent = $infos_json['infos']['agent'];

	}else{

		$infos_depot = $obj_infoClient->depot();
		$infos_date_recupereation = $obj_infoClient->date_recuperation();

		$infos_recuperer = $obj_infoClient->recuperer();
		$agent = $obj_infoClient->getAgentByDate();
	}
?>
