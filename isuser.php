<?php  
    require_once 'auto_load.php';
    session_start();

    $loguser = false;

    if(isset($_GET['error'])) {
        echo "<p class='error'>".$_GET['error']."</p>";
    }
    if(isset($_GET['message'])) {
        echo "<p class='message'>".$_GET['message']."</p>";
    }

    if(isset($_SESSION['loggeduser'])) {
        $loguser = $_SESSION['loggeduser'];        
    }

?>


           