<?php  
    require_once('isadmin.php');
    $usr = new user();
    $users = $usr->selectAll();
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>eCommerce - Display All Users</title>
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
            <hr />

            <section id="main-content" class="clearfix">
                <div id="users-list">
                    <h1>Display All Users</h1>

                        <table border="1" class="users-table">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Credit Limit</th>
                                <th>controls</th>
                            </tr>
                            <?php 
								foreach ($users as $user) {
									if($user->name === "admin")
										continue;
                                    if($user->iduser === $loguser->iduser)
                                        continue;
									echo "<tr>";
									echo "<td>".$user->iduser."</td>";
									echo "<td>".$user->name."</td>";
									echo "<td>".$user->email."</td>";
									echo "<td>".$user->creditlimit."</td>";
									echo "<td>";
							?>

									<a href="profile.php?id=<?= $user->iduser ?>">view info
                                    </a>  
									<a class="remove-icon" href="delete-user.php?id=<?= $user->iduser ?>">delete
									 	<img src="img/remove.gif" alt="Remove user" />
										
                                    </a>
                                    

							<?php   echo"</td>";
									echo "</tr>";
								}	
							?>
                        </table>
                </div><!-- end new-account -->
            </section><!-- end main-content -->

            <hr />

<?php require_once 'footer.php'; ?>
