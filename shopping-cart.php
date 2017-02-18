<?php
    require_once 'isuser.php';
    if(!$loguser) {
        header('Location: signin.php?error=you are not logged in, please log in first');
        exit;
    }
    $products= false;
    $cart=order::selectCart($loguser->iduser);
    if($cart) {
        $cart->setProducts();
        $products = $cart->products;
    }
    $ordertotal = 0;
    if(isset($_GET['error'])) {
        echo "<p class='error'>".$_GET['error']."</p>";
    }
    if(isset($_GET['message'])) {
        echo "<p class='message'>".$_GET['message']."</p>";
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
        <title>eCommerce - Shopping Cart & Checkout</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
        <script src="js/vendor/jquery-3.1.1.js"></script>
        <script type="text/javascript">

            function UpdateView(){
                var total=0;
                $("table > tbody > tr > td:nth-child(5)").each(function(number,elt){
                    var qty = $(this).parents("tr").children("td")[3].children[0].value;
                    var price =$(this).parents("tr").children("td")[2].innerText.substring(1);
                    elt.innerHTML="$ "+qty*price+' <a class="remove" href="#"><img src="img/remove.gif" alt="Remove product" /></a>';
                    total+=qty*price;
                    $('a.remove').on('click',function(evt){
                        evt.preventDefault();
                        $.ajax({
                            url: 'remove-from-cart.php',
                            method:"GET",
                            data: {'qty': $(this).val() , 'name': $(this).parents("tr").children("td")[1].innerText },
                            dataType: 'JSON',
                            async:true
                        });
                        $(this).parents("tr").remove();
                        UpdateView();
                    });//Delete from cart
                });
                $(".total > td:nth-child(1) > span:nth-child(2)")[0].innerText = "TOTAL: $"+total;

            }
            $(function(){
                UpdateView();
                $('.qty').on('keyup',function(evt){
                    evt.preventDefault();
                    UpdateView();
                    $.ajax({
                        url: 'addtocart.php',
                        method:"GET",
                        data: {'qty': $(this).val() , 'name': $(this).parents("tr").children("td")[1].innerText },
                        dataType: 'JSON',
                        async:true
                    });
                });//end of handler

            });//end of load
        </script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <div id="wrapper">
            <?php require_once'header.php'; ?>
            <hr />

            <section id="main-content" class="clearfix">
                <div id="shopping-cart">
                    <h1>Shopping Cart & Checkout</h1>

                    <form action="checkout.php" method="post">
                        <table border="1">
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Unit Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                            </tr>
                        <?php if($products): ?>
                            <?php foreach ($products as $key=>$product): ?>
                            <?php
                                $subtotal = $product->quantity * $product->unitprice;
                                $ordertotal += intval($subtotal);
                            ?>
                            <tr>
                                <td><?= $key+1; ?></td>
                                <td>
                                    <img src="img/products/<?=$product->image?>" alt="Product" width="65" height="37" /><?=$product->name?>
                                </td>
                                <td>$ <?=$product->unitprice?></td>
                                <td>
                                    <input type="text" value="<?= $product->quantity; ?>" maxlength="2" class="qty" />
                                    <!-- <a href="addtocart.php?qty">
                                        <img src="img/refresh.gif" alt="Refresh cart" />
                                    </a> -->
                                </td>
                                <td>
                                    $<?= $subtotal; ?>
                                    <a class="remove" href="#">
                                        <img src="img/remove.gif" alt="Remove product" />
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                            <tr class="total">
                                <td colspan="5">
                                    <br />
                                    <span>TOTAL: $<?= $ordertotal; ?></span><br />

                                    <a href="index.php" class="tertiary-btn">CONTINUE SHOPPING</a>
                                    <input type="submit" value="CHECKOUT WITH PAYPAL" class="secondary-cart-btn">
                                </td>
                            </tr>
                        </table>
                    </form>
                </div><!-- end new-account -->
            </section><!-- end main-content -->

            <hr />
            <?php require_once'footer.php'; ?>
