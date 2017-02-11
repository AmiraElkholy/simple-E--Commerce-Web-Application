<?php  
	require_once 'auto_load.php';

	$email = $_GET['email'];

	$user = new user();

	if($user->isvalidemail($email)) {
	}
	else {
		echo json_encode('* This email already exits in our database, <a href="signin.php">sign-in</a> or try another email');
	}


?>