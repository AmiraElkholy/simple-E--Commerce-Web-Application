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
        <title>eCommerce - Manage Categories</title>
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
                <div id="shopping-cart"">
                    <section id='view-info' class='catman'>
                    <h1>Manage Categories</h1>
                    <a class='add' href=add-category.php>add new category</a></br></br>
                    <?php
                    require_once 'auto_load.php';
                    $cat=new category();
                    $sup=$cat->selectsup(); 
                    foreach($sup as $sp){
                        echo "<ul><h4>".$sp->name.":<section class='actions'><a class='add' href=add-subcategory.php?id=".$sp->idcategory."&name=".$sp->name.">Add Subcategory</a>
                                                        <a class='update' href=update-category.php?id=".$sp->idcategory."&name=".$sp->name."&super=".$sp->idsupercategory.">Update</a>
                                                        <a class='delete' href=control-delete-category.php?id=".$sp->idcategory.">Delete</a></h4><section>";
                        $sub=$cat->selectcatbysupid($sp->idcategory);
                        foreach($sub as $sb){
                            echo "<li>- ".$sb->name."<section class='actions'><a class='update' href=update-category.php?id=".$sb->idcategory."&name=".$sb->name."&super=".$sb->idsupercategory.">Update</a>
                                                        <a class='delete' href=control-delete-category.php?id=".$sb->idcategory.">Delete</a></li><section>";
                        }
                        echo "</ul></br><hr/>";
                    }
                    $ind=$cat->selectind2();
                    foreach($ind as $in){
                        echo "<h4>".$in->name."<section class='actions'><a class='add' href=add-subcategory.php?id=".$in->idcategory."&name=".$in->name.">Add Subcategory</a>
                                                    <a class='update' href=update-category.php?id=".$in->idcategory."&name=".$in->name."&super=".$in->idsupercategory.">Update</a>
                                                    <a class='delete' href=control-delete-category.php?id=".$in->idcategory.">Delete</a><section></h4>";
                    }
                    
                    
                    ?>
                    </section>
                </div><!-- end new-account -->
            </section><!-- end main-content -->

            <hr/>

    <?php
    require_once 'footer.php';
    ?>
