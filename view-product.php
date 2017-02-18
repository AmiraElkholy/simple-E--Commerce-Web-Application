<?php
    require_once('isuser.php');

    if(isset($_GET['name'])&&!empty($_GET['name'])) {
        $product = product::selectbyname($_GET['name']);
        if(!$product) {
            echo "failed to view product";
            die;
        }
    }
    else {
        echo "no product selected to display";
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
        <title>eCommerce - Product</title>
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
                <div id="product-image">
                    <img src="img/products/<?=$product->image?>" alt="Product">
                </div><!-- end product-image -->
                <div id="product-details">
                    <h1><?=$product->name?></h1>
                    <p><?=$product->description?></p>

                    <hr />
                    <?php if($product->quantity > 0 && $loguser) {?>
                        <form action="addtocart.php" method="get">
                            <label for="qty">Qty:</label>
                            <input type="text" id="qty" name="qty" value="1" maxlength="2">
                            <input type="hidden" name="name" value="<?=$product->name?>" >
                            <button type="submit" class="secondary-cart-btn">
                                <?php if(!order::hasThisInCart($product->idproduct, $loguser->iduser)): ?>
                                <img src="img/white-cart.gif" alt="Add to Cart" />
                                 ADD TO CART
                                <?php else: ?>
                                <img src="img/white-cart.gif" alt="Already In Cart"> ALREADY IN CART </a>
                                <?php endif; ?>
                            </button>
                        </form>
                    <?php } ?>

                </div><!-- end product-details -->
                <div id="product-info">
                    <p class="price">$<?=$product->price?></p>
                    <p>Availability:
                        <?php
                            if($product->quantity > 0)echo "<span>In Stock</span>";
                            else echo "<span>Out of Stock</span>";
                        ?>
                    </p>
                    <p>Product Code: <span><?=$product->idproduct?></span></p>
                </div><!-- end product-info -->
            </section><!-- end main-content -->
            <hr />

<?php require_once 'footer.php'; ?>
