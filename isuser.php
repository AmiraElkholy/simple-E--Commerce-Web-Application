<?php
    require_once 'auto_load.php';
    session_start();

    $loguser = false;

    if(isset($_SESSION['loggeduser'])) {
        $loguser = $_SESSION['loggeduser'];
    }

?>
