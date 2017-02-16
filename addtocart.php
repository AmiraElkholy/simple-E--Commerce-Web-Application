<?php
require_once('isuser.php');

if ($loguser) {
    if (isset($_GET['name'])&& $product=product::selectbyname($_GET['name'])) {
        if (isset($_GET['qty'])) $product->qty=intval($_GET['qty']); else $product->qty= 1;
        if ($product->quantity >  $product->qty) {
            if (!$order=order::hasOrderInCart($loguser->iduser)) {
                $order = order::createobj($loguser->iduser);
                $order->insert();
                $order=order::selectCart($loguser->iduser);
                @$order->addProduct($product);
            }
            else {
                if (!order::isInOrder($product->idproduct,$order->idorder)) {
                    @$order->addProduct($product);
                }
            }
        }
    }
    header("Location: shopping-cart.php");
}
else {
    header("Location: signin.php?error=Sorry You need to login ");
}
 ?>
