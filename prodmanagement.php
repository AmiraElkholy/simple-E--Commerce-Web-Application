<?php
    require_once 'isadmin.php';
    $products = product::selectAll();
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>eCommerce - Manage Products</title>
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
                <div id="shopping-cart">
                    <h1>Manage Products: </h1>
                    <a id="floatadd" class="add" href="new-product.php">add new product</a>
                    <br><br>
                        <table border="1">
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Unit Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                            </tr>
                        <?php if($products): ?>
                            <?php foreach ($products as $product): ?>
                            <tr>
                                <td><?= $product->idproduct; ?></td>
                                <td>
                                    <img src="img/products/<?= $product->image; ?>" alt="Product" width="65" height="37" />
                                    <?= $product->name ?>
                                </td>
                                <td>$<?= $product->price; ?></td>
                                <td>
                                    <label><?= $product->quantity; ?></label>
                                </td>
                                <td>
                                    <a href="#">
                                        <a class="update-prod" href="update-product.php?name=<?= $product->name; ?>">update
                                    </a>  
                                    <a class="remove-icon" href="delete-product.php?name=<?= $product->name; ?>">delete
                                        <img src="img/remove.gif" alt="Remove user" />
                                        
                                    </a>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                        </table>
                </div>
            </section><!-- end main-content -->

            <hr/>

    <?php
    require_once 'footer.php';
    ?>
