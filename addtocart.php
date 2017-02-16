<?php
require_once('isuser.php');

if ($loguser) {
    if (isset($_GET['name'])&& $product=product::selectbyname($_GET['name'])) {
        if (isset($_GET['qty'])) $product->qty=intval($_GET['qty']); else $product->qty= 1;

        if (!$order=order::hasOrderInCart($loguser->iduser)) {
            $order = order::createobj($loguser->iduser);
            $order->insert();
        }
        if (!order::isInOrder($product->idproduct,$order->idorder)) {
            if (@$order->addProduct($product)) echo "product added to cart";
            else echo "failed to add to cart";
        }
    }
}
else {
    header("Location: signin.php?error=Sorry You need to login ");
}
 ?>
