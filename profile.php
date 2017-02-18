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
        <title>eCommerce - Personal Details</title>
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
                <aside id="my-account-menu">
                    <h3>ACCOUNT</h3>
                    <ul>
                        <li><a href="profile.php">My Account</a></li>
                        <li><a href="order-history.php">Order History</a></li>
                        <li><a href="signout.php">Sign Out</a></li>
                    </ul>
                </aside><!-- end my-account-menu -->
                <!-- <div class="personal-details"> -->
                <div id="personal-details">
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
                    			echo "<label id='interests' class='info-label'>";
								foreach ($userinterests as $i) {
									echo "<span> - ";
									$curcat = $cat->selectcatbyid($i->idcategory);
									echo $curcat[0]->name;
									echo "</span>";
								}
								echo "</label>";
                    		}
                    		else {
                    			echo "<label class='info-label'>";
                    			echo "No Interests!";
                    			echo "</label>";
                    		}
                    	?>
                        </p>
                <!-- </div> -->

                        

  
                </div><!-- end new-account -->
            </section><!-- end main-content -->

            <hr />

<?php require_once 'footer.php'; ?>