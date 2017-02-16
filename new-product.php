<?php
    require "isuser.php";
    product::addNewProduct();
 ?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>eCommerce - Add New Product</title>
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
        
            <?php require_once 'header.php' ?>

            <hr />

            <section id="main-content" class="clearfix">
                <div id="new-account">
                    <h1>Add New Product</h1>

                    <form action="#" method="post" enctype="multipart/form-data">
                        <p>
                            <label for="name">
                                <span class="required-field">*</span> Product name
                            </label>
                            <input type="text" id="name" name="name" required>
                        </p>
                        <p>
                            <label for="price">
                                <span class="required-field">*</span> Product price
                            </label>
                            <input type="number" id="price" name="price" min="0.01" step="0.01" required><span> $</span>
                        </p>
                        <p>
                            <label for="quantity">
                                <span class="required-field">*</span> Product quantity
                            </label>
                            <input type="number" id="quantity" name="quantity" min="0" required>
                        </p>
                        <p>
                            <label for="description">
                                <span class="required-field">*</span> Product description
                            </label>
                            <textarea id="description" name="description" required  rows="6"></textarea>
                        </p>
                        <p>
                            <label for="image">
                                <span class="required-field">*</span>Product image
                            </label>
                            <input type="hidden" name="MAX_FILE_SIZE" value="5000000">
                            <input type="file" id="image" name="image" accept="image/jpeg" accept="image/x-png" required>
                        </p>
                        <p>
                            <label for="idcategory">
                                <span class="required-field">*</span>Product category
                            </label>
                            <select name="idcategory">
                            <?php
                                $cat=new category();
                                $sup=$cat->selectsup(); 
                                foreach($sup as $sp){
                                    echo "<option disabled>----".$sp->name."</option>";
                                    $sub=$cat->selectcatbysupid($sp->idcategory);
                                    foreach($sub as $sb){
                                        echo "<option value=".$sb->idcategory.">".$sb->name."</option>";
                                    }                                
                                }
                            ?>
                            </select>
                        </p>

                        <p>Fields marked with <span class="required-field">*</span> are required.</p>

                        <hr />

                        <input type="submit" value="ADD NEW PRODUCT" class="secondary-cart-btn">
                    </form>
                </div><!-- end new-account -->
            </section><!-- end main-content -->

            <hr />

<?php require_once 'footer.php'; ?>