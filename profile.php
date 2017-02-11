<?php 
	require_once 'auto_load.php';
	session_start();


	if(isset($_SESSION['loggeduser'])) {
		$loguser = $_SESSION['loggeduser'];
		
		echo "profile.php "."hello ".$loguser->name;

			
	}
	else {
		header('Location: signin.php?error=you are not logged in, please log in first');
		exit;
	}


?>