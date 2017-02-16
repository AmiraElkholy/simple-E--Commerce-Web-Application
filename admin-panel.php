<?php  
	require_once 'isadmin.php';
?>



<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>eCommerce - Admin Panel</title>
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
            <?php require_once('header.php'); ?>
            <hr />

            <section id="main-content" class="clearfix">
                <div id="adminPanel">
                    <h1>Admin Panel</h1>

                    <hr />

                    <ul>
                        <li><a href="users-list.php">Manage users</a></li>
                        <li><a href="catmanagement.php">Manage categories</a></li>
                        <li><a href="add-category.php">Add new category</a></li>
                        <li><a href="new-product.php">Add new product</a></li>
                    </ul>

                    <a href="index.php" class="home-btn">Go To Home Page</a>
                     
                </div><!-- end new-account -->
            </section><!-- end main-content -->

            <hr />

<?php require_once 'footer.php'; ?>
            