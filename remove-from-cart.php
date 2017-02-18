<?php
require_once('isuser.php');
if ($loguser) {
    if (isset($_GET['name'])&& $product=product::selectbyname($_GET['name'])) {
        if ($order=order::hasOrderInCart($loguser->iduser)) {
            if (order::isInOrder($product->idproduct,$order->idorder)) {
                @$order->removeProduct($product);
            }
        }

    }
    header("Location: shopping-cart.php");
}
else {
    header("Location: signin.php?error=Sorry You need to login ");
}?>
