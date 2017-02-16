<?php  
    require_once('isuser.php');
    if(isset($_GET['id'])&&!empty($_GET['id'])) {
        //get category name from database
        $catid = $_GET['id'];
        $cat = new category();
        $supercategory = ($cat->selectcatbyid($catid));
        if(!$supercategory) {
            echo "failed to display category";
            exit;
        }
        $supercategory = $supercategory[0];
        $products = product::selectAllbycatid($catid);
        if(!$products) {
            $subcat = new category();
            $subcategroies = $subcat->selectcatbysupid($catid);
        }
    }
    else {
        echo "no category selected to display";
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
        <title>eCommerce - Category</title>
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

            <section id="main-content" class="clearfix">
                <h2><?= $supercategory->name ?></h2>
                <hr>

                <aside id="categories-menu">
                    <h3>CATEGORIES</h3>
                    <?php $catt = new category();
                        $catts = $catt->selectind(); ?>
                    <ul>
                        <?php if($catts): ?>
                                <?php foreach ($catts as $catt): ?>
                                    <li>
                                    <a href="category.php?id=<?= $catt->idcategory ?>"><?= $catt->name; ?></a>
                                    </li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                    </ul>
                </aside><!-- end categories-menu -->

                <div id="listings">

                <?php if($products): ?>
                <?php foreach ($products as $product): ?>
                    <div class="product">
                        <a href="view-product.php?name=<?= $product->name ?>"><img id="productImage" src="img/products/<?= $product->image; ?>" alt="<?= $product->name ?>" class="feature"></a>

                        <h3><a href="view-product.php?name=<?= $product->name ?>"><?= $product->name ?></a></h3>

                        <p><?= $product->description; ?></p>


                        <?php if($product->quantity > 0): ?>
                        <h5>Availability: <span class="instock">In Stock</span></h5>
                        <?php else: ?>
                        <h5>Availability: <span class="outofstock">Out of Stock</span></h5>                            
                        <?php endif; ?>

                        <p>
                            <a href="#" class="cart-btn">
                                <span class="price">$<?= $product->price; ?></span>
                                 <img src="img/white-cart.gif" alt="Add to Cart">ADD TO CART</a>
                        </p>
                    </div>
                <?php endforeach; ?>
                <?php else: ?>
                    <?php if($subcategroies): ?>                      
                    <?php foreach ($subcategroies as $subcategory) {

                        $catproducts = product::selectAllbycatid($subcategory->idcategory); 
                        ?>
                        <?php if($catproducts): ?>
                            <?php foreach ($catproducts as $catproduct): ?> 
                    <div class="product">
                        <a href="view-product.php?name=<?= $catproduct->name ?>"><img id="productImage" src="img/products/<?= $catproduct->image; ?>" alt="<?= $catproduct->name ?>" class="feature"></a>

                        <h3><a href="view-product.php?name=<?= $catproduct->name ?>"><?= $catproduct->name ?></a></h3>

                        <p><?= $catproduct->description; ?></p>


                        <?php if($catproduct->quantity > 0): ?>
                        <h5>Availability: <span class="instock">In Stock</span></h5>
                        <?php else: ?>
                        <h5>Availability: <span class="outofstock">Out of Stock</span></h5>                            
                        <?php endif; ?>

                        <p>
                            <a href="#" class="cart-btn">
                                <span class="price">$<?= $catproduct->price; ?></span>
                                 <img src="img/white-cart.gif" alt="Add to Cart">ADD TO CART</a>
                        </p>

                        <p class="wish">
                            <a href="category.php?id=<?= $subcategory->idcategory; ?>">
                                <img src="img/wish.gif">
                                 Found in <?= $subcategory->name; ?>
                            </a>
                        </p>           
                    </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php 
                     }
                    ?>
                    <?php endif; ?>
                <?php endif; ?>

                </div><!-- end listings -->
            </section><!-- end main-content -->

            <hr />

            <!-- <section id="pagination">
                <p>Page: 
                    <span class="current">1</span> / 
                    <a href="#">2</a> / 
                    <a href="#">3</a>
                </p>
            </section> --><!-- end pagination -->

            <hr />

            <footer>
                <section id="contact">
                    <h3>For phone orders please call 1-800-000. You<br>can also email us at <a href="mailto:office@shop.com">office@shop.com</a></h3>
                </section><!-- end contact -->

                <hr />

                <section id="links">
                    <!-- <div id="my-account">
                        <h4>MY ACCOUNT</h4>
                        <ul>
                            <li><a href="#">Sign In</a></li>
                            <li><a href="#">Sign Up</a></li>
                            <li><a href="#">Wishlist</a></li>
                            <li><a href="#">Order History</a></li>
                            <li><a href="#">Shopping Cart</a></li>
                        </ul>
                    </div> --><!-- end my-account -->
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
