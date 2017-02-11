<?php 
	require_once 'auto_load.php';
	session_start();

	if(isset($_SESSION['loggeduser'])) {
		$user = $_SESSION['loggeduser'];
		session_destroy();
		header('Location: signin.php?message=you are logged out ,,');
		exit;
	}
	if(isset($_COOKIE['email'])) {
		setcookie('email','',time()-(10*60*60));
	}

	else {
		header("Location: signin.php?error=you are not logged in, you can't log out");
		exit;
	}

?>