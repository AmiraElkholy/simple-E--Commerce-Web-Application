<div id="wrapper" class="msg">

<?php 
	require_once 'auto_load.php';
	session_start();

	if(isset($_GET['error'])) {
        echo "<p class='error'>".$_GET['error']."</p>";
    }
    if(isset($_GET['message'])) {
        echo "<p class='message'>".$_GET['message']."</p>";
    }

	if(isset($_SESSION['loggeduser'])) {
		$loguser = $_SESSION['loggeduser'];
		
		if($loguser->isadmin == 1) {
			
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
</div>
