<?php 
	require_once 'auto_load.php';
	session_start();


	if(isset($_SESSION['loggeduser'])) {
		$loguser = $_SESSION['loggeduser'];
		
		echo "profile.php "."hello ".$loguser->name;


		$interest = new interest();
		$interest->iduser = $loguser->iduser;
		$userinterests = $interest->selectuserinterests();

		$cat = new category();



		echo "<ul>";
		foreach ($userinterests as $i) {
			# code...
			$curcat = $cat->selectcatbyid($i->idcategory);
			echo "<li>".$curcat[0]->name."</li>";
		}
		echo "</ul>";
			
	}
	else {
		header('Location: signin.php?error=you are not logged in, please log in first');
		exit;
	}


?>