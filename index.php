<?php
    require_once('isuser.php');
    $featuredproducts = product::selectAll();
    if($featuredproducts) {
        if(count($featuredproducts)>=4) {
            $featuredproducts = array_slice($featuredproducts, 0, 4);
        }
    }
    else { }
 ?>
 <!DOCTYPE html>
 <!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
 <!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
 <!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
 <!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
     <head>
         <meta charset="utf-8">
         <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
         <title>eCommerce - Home</title>
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

         <?php require_once('header.php');  ?>

         
            <section id="promo">
                <div id="promo-details">
                    <h1>Today's Deals</h1>
                    <p>Checkout this section of<br />
                     products at a discounted price.</p>
                    <a href="#products" id="shopnow" class="default-btn">Shop Now</a>
                </div><!-- end promo-details -->
                <img src="img/promo.png" alt="Promotional Ad">
            </section><!-- promo -->

            <section id="main-content">
                <h2>Featured</h2>
                <hr>
                <div id="products">
                <?php if($featuredproducts): ?>
                <?php foreach ($featuredproducts as $product): ?>
                    <?php require 'product.php'; ?>
                <?php endforeach; ?>
                <?php endif; ?>
                </div><!-- end products -->
            </section><!-- end main-content -->

            <hr />

<?php require_once 'footer.php'; ?>
