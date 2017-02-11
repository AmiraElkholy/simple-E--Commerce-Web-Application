<?php 
	require_once 'auto_load.php';
	session_start();


	if(isset($_SESSION['loggeduser'])) {
		
		$loguser = $_SESSION['loggeduser'];

		if($loguser->name == "admin") {
		
			$user = new user();

			$user->iduser = $_GET['id'];

			$state =  $user->delete();

			if($state) {
				echo "success";
				header('Location: users-list.php');
			}

			else {
				echo "Error in Deleting User .. ";
			 	echo "<br>";
			 	echo "<a href='users-list.php'>Back</a>";
				header('Location: users-list.php?error=Error in deleting user .. !! ');
			}
		}

		else {
			header('Location: signin.php?error=you are not allowed access.. ');
			exit;
		}		
	}
	else {
		
		header('Location: signin.php?error=you are not logged in, please log in first');
		exit;
	}

	
?>