<?php 
    require_once 'auto_load.php'; 
    session_start();

    if($_POST) {
            $user = new user();
            $user->email = $_POST['email'];
            $user->password = sha1($_POST['password']);

            $usr = $user->login();

            if($usr) {
                if($usr->isadmin == 1) {
                    $_SESSION['loggeduser'] = $usr;
                    header('Location: admin-panel.php');
                    if(isset($_POST['remeber'])) {
                        setcookie('email', $usr->email, time()+(60*60*24*30));
                    }
                }
                else {
                    $_SESSION['loggeduser'] = $usr;
                    header('Location: shopping-cart.php');
                    if(isset($_POST['remeber'])) {
                        setcookie('email', $usr->email, time()+(60*60*24*30));
                    }
                }
            }
            else {
                header('Location: signin.php?error=your login failed, wrong email or password');
            }
    }


?>