<?php  
	function __autoload($classname) {
		require_once "classes.php/".$classname.".php";
	}







?>
