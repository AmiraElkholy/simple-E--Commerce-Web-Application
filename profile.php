<?php 
	require_once 'auto_load.php';
	session_start();


	if(isset($_SESSION['loggeduser'])) {
		$loguser = $_SESSION['loggeduser'];
		
		// echo "profile.php "."hello ".$loguser->name;
		if($loguser->isadmin == 1) {
			if(isset($_GET['id'])&&!empty($_GET['id'])) {
				$id = $_GET['id'];
				$usr = new user();
				$user = $usr->selectbyid($id);
				if(!$user) {
					echo "Failed to view user info";
					exit;
				}
			}
			else {
				$user = $loguser;
			}
		}
		else {
			$user = $loguser;
		}//end of admin condition

		$interest = new interest();
		$interest->iduser = $user->iduser;
		$userinterests = $interest->selectuserinterests();

		$cat = new category();
			
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
        <title>eCommerce - Create New Account</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

        <link rel="stylesheet" href="css/main.css">
        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
    </head>
    <body>
    <!--[if lt IE 7]>
        <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
    <![endif]-->


        <div id="wrapper">
           	<?php require_once('header.php') ?>

            <hr />

            <section id="main-content" class="clearfix">
                <div id="view-info">
                    <h1>View Info</h1>
                	
                    <br>
                        <p>
                            <label>
                                NAME:
                            </label>
                            <label class="info-label">
                            	<?= $user->name; ?>
                            </label>
                        </p>
                        <p>
                            <label>
                                EMAIL:
                            </label>
                            <label class="info-label">
                            	<?= $user->email; ?>
                            </label>
                        </p>
                        <p>
                            <label>
                                BIRTHDATE:
                            </label>
                            <label class="info-label">
                            	<?= $user->birthdate; ?>
                            </label>
                        </p>
                        <p>
                            <label>
                                JOB:
                            </label>
                            <label class="info-label">
                            	<?= $user->job; ?>
                            </label>
                        </p>
                        <p>
                            <label>
                               ADDRESS:
                            </label>
                            <label class="info-label">
                            	<?= $user->address; ?>
                            </label>
                        </p>
                        <p>
                            <label>
                                CREDIT LIMIT:
                            </label>
                           <label class="info-label">
                            	<?= $user->creditlimit; ?>
                            </label>
                        </p>
                        <p>
                        	<label>INTERESTS:</label>
                    	<?php 
                    		if($userinterests) {
                    			echo "<label class='info-label'>";
                    			echo "<ul>";
								foreach ($userinterests as $i) {
									echo "<li>";
									$curcat = $cat->selectcatbyid($i->idcategory);
									echo $curcat[0]->name;
									echo "</li>";
								}
								echo "</ul>";
								echo "</label>";
                    		}
                    		else {
                    			echo "<label class='info-label'>";
                    			echo "No Interests!";
                    			echo "</label>";
                    		}
                    	?>
                        </p>

                        

  
                </div><!-- end new-account -->
            </section><!-- end main-content -->

            <hr />

            <footer>
                <section id="contact">
                    <h3>For phone orders please call 1-800-000. You<br>can also email us at <a href="mailto:office@shop.com">office@shop.com</a></h3>
                </section><!-- end contact -->

                <hr />

                <section id="links">
                    <div id="my-account">
                        <h4>MY ACCOUNT</h4>
                        <ul>
                            <li><a href="#">Sign In</a></li>
                            <li><a href="#">Sign Up</a></li>
                            <li><a href="#">Wishlist</a></li>
                            <li><a href="#">Order History</a></li>
                            <li><a href="#">Shopping Cart</a></li>
                        </ul>
                    </div><!-- end my-account -->
                    <div id="info">
                        <h4>INFORMATION</h4>
                        <ul>
                            <li><a href="#">Terms of Use</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                        </ul>
                    </div><!-- end info -->
                    <div id="extras">
                        <h4>EXTRAS</h4>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Contact Us</a></li>
                        </ul>
                    </div><!-- end extras -->
                </section><!-- end links -->

                <hr />

                <section class="clearfix">
                    <div id="copyright">
                        <div id="logo">
                            <a href="#"><span id="logo-accent">e</span>Commerce</a>
                        </div><!-- end logo -->
                        <p id="store-desc">This is a short description of the store.</p>
                        <p id="store-copy">&copy; 2013 eCommerce. Theme designed by Adi Purdila.</p>
                    </div><!-- end copyright -->
                    <div id="connect">
                        <h4>CONNECT WITH US</h4>
                        <ul>
                            <li class="twitter"><a href="#">Twitter</a></li>
                            <li class="fb"><a href="#">Facebook</a></li>
                        </ul>
                    </div><!-- end connect -->
                    <div id="payments">
                        <h4>SUPPORTED PAYMENT METHODS</h4>
                        <img src="img/payment-methods.gif" alt="Supported Payment Methods">
                    </div><!-- end payments -->
                </section>
            </footer>
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
