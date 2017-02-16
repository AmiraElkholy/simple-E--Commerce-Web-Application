<?php
    require_once 'isadmin.php';
    if(!(isset($_GET['id'])&&!empty($_GET['id']))) {
        echo "error in adding subcategory";
        die;    
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
        <title>eCommerce - Add Subcategory</title>
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
                require_once 'header.php'
            ?>
            <hr />

            <section id="main-content" class="clearfix">
                <div id="shopping-cart">
                    <h1>Categories Management</h1>
                    <h3>add subcategory to: <?=$_GET['name']?> </h3>
                    </br>
                    <?php
                    require_once 'auto_load.php';
                    $cat=new category();
                    $sup=$cat->selectsup();
                    ?>
                        <form method="post" action="control-add-subcategory.php">
                            <label for="subcategory">Subcategory: </label>
                            <input type="text" name="subcategory" required>
                            <input type="hidden" name="id" value="<?=$_GET['id']?>">
                            </br></br>
                            <input type="submit" class="secondary-cart-btn">
                        </form>
                        </br>


                </div>
                <!-- end new-account -->
            </section>
            <!-- end main-content -->

            <hr />

<?php require_once 'footer.php'; ?>