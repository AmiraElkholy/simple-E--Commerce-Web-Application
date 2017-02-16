<?php  
    require_once 'isuser.php';
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>eCommerce - Contact Us</title>
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
            <?php require_once 'header.php'; ?>

            <hr />

            <section id="main-content" class="clearfix">
                <div id="contact-us">
                    <h1>Contact Us</h1>

                    <hr />

                    <p>We are located at:</p>

                    <p>
                        <span>eCommerce</span><br />
                        123 Main Street<br />
                        Suite A<br />
                        Los Angeles, CA 90014
                    </p>

                    <p>For customer service please call us: <span>1-800-8888</span></p>

                    <p>Alternatively, you can contact <a href="mailto:support@shop.com">customer service by email</a>.</p>

                    <hr />

                    <p class="note">* For order related inquiries, please use the contact information provided below.</p>
                </div><!-- end contact-us -->
            </section><!-- end main-content -->

            <hr />

<?php require_once 'footer.php'; ?>