<?php 
    require_once 'isuser.php';

    if(isset($_GET['error'])) {
        echo "<p class='error'>".$_GET['error']."</p>";
    }
    if(isset($_GET['message'])) {
        echo "<p class='message'>".$_GET['message']."</p>";
    }

    if(isset($_SESSION['loggeduser'])||isset($_COOKIES['email'])) {
        if(isset($_COOKIES['email'])) {
            $usr = new user();
            $loguser = $usr->selectbyemail($_COOKIES['email']);
            $_SESSION['loggeduser'] = $loguser;
        } 
        else {
            $loguser = $_SESSION['loggeduser'];
        }
        //redirect user
        if($loguser->isadmin == 1) {
            header('Location: admin-panel.php');
        }
        else {
            header('Location: index.php');
        }
    }
  

?>






<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>eCommerce - Sign In</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <div id="wrapper">
            <?php require_once('header.php') ?>

            <section id="signin-form">
                <h1>I have an account</h1>
                <form action="signin-process.php" method="post">
                    <p>
                        <img src="img/email.gif" alt="Email Address">
                        <input type="email" name="email" placeholder="Email Address">
                    </p>
                    <p>
                        <img src="img/password.gif" alt="Password">
                        <input type="password" name="password" placeholder="******">
                    </p>
                    <p>
                        <label for="remeber" class="check-label">
                            <input type="checkbox" name="remeber" id="remeber">
                            Remember me
                        </label>
                    </p>

                    <button type="submit" class="secondary-cart-btn">
                        SIGN IN
                    </button>
                </form>
            </section><!-- end signin-form -->
            <section id="signup">
                <h2>I'm a new customer</h2>
                <h3>You can create an account in just a few simple steps.<br>
                    Click below to begin.</h3>

                <a href="new-account.php" class="default-btn">CREATE NEW ACCOUNT</a>
            </section><!--- end signup -->

            <hr />

<?php require_once 'footer.php'; ?>
  