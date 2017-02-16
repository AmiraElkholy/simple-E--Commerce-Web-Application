<?php
    require_once 'isuser.php';

    if(isset($_GET['error'])) {
    echo "<p class='error'>".$_GET['error']."</p>";
    }
    if(isset($_GET['message'])) {
        echo "<p class='message'>".$_GET['message']."</p>";
    }
 
    //check if user is logged in..
    if(isset($_SESSION['loggeduser'])) {
        $loguser = $_SESSION['loggeduser'];

    }
    else {
        header('Location: signin.php?error=you are not logged in, please log in first');
        exit;
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
        <title>eCommerce - Order History</title>
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
            <?php
                require_once 'header.php';
            ?>

            <hr />

            <section id="main-content" class="clearfix">
                <aside id="my-account-menu">
                    <h3>ACCOUNT</h3>
                    <ul>
                        <li><a href="profile.php">My Profile</a></li>
                        <li><a href="order-history.php">Order History</a></li>
                        <li><a href="signout.php">Sign Out</a></li>
                    </ul>
                </aside><!-- end my-account-menu -->

                <div id="order-history">
                    <h1>Order History</h1>
                    
                    <?php
                        $order=order::selectbyUserid($loguser->iduser);
                        
                    ?>
                    <table border="1">
                        <tr>
                            <td>Order ID</td>
                            <td>Date - Time</td>
                            <td>Total Amount</td>
                        </tr>
                        <?php
                        foreach($order as $ord){
                        $ord->setProducts();
                        $amount=$ord->calcTotAmount();
                        echo "<tr>";
                            echo "<td>$ord->idorder</td>";
                            echo "<td>$ord->date</td>";
                            echo "<td>$amount</td>";
                        echo "</tr>";
                        }
                        ?>

                    </table>

                </div><!-- end order-history -->
            </section><!-- end main-content -->
            <hr />
<?php
require_once 'footer.php';
?>


        </div><!-- end wrapper -->

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src='//www.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
    </body>
</html>
