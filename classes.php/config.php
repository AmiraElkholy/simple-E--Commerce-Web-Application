<?php
$dbhost= 'localhost';
$dbuser= 'root';
$dbpass='iti';
$dbname='E-Commerce';
// open connection
$mysqli = new mysqli($dbhost, $dbuser,$dbpass);
$mysqli->select_db($dbname);

 if (mysqli_connect_errno()) {
    printf("Connect failed: %s", mysqli_connect_error());
    exit();
}

 ?>
