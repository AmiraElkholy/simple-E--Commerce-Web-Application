<?php
$dbhost= 'localhost';
$dbuser= 'root';
$dbpass='iti';
$dbname='E-Commerce';
// open connection
$mysqli = new mysqli($dbhost, $dbuser,$dbpass);
$mysqli->select_db($dbname);

 	if(!$mysqli) {
        echo "connection failed ".$mysqli->errno." : ".$mysqli->error."<br>";
        die;
    }
 ?>
