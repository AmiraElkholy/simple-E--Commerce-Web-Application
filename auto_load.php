<?php
	function __autoload($classname) {
		require_once "classes.php/".$classname.".php";
	}



	function test_input($data) {
	    $data = trim($data);
	    $data = stripslashes($data);
	    $data = htmlspecialchars($data);
	    return $data;
    }


?>
