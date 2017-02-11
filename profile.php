<?php 
	require_once 'auto_load.php';
	session_start();
	ob_start();

	
	$loguser = $_SESSION['loggeduser'];


	echo "profile.php    "."hello ".$loguser->name;


?>