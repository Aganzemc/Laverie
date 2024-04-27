<?php
//DATABASE CONNECTION
	$connect = new mysqli("localhost", "root", "") or die (mysqli_error($connect));
	mysqli_select_db($connect,'laveriedb');

	if(!isset($_SESSION)) session_start();
?>