<?php
require_once('isuser.php');
// echo json_encode($GET);
if ($loguser) {
    if (isset($_GET['name'])&& $product=product::selectbyname($_GET['name'])) {
        if (isset($_GET['qty'])) $product->qty=intval($_GET['qty']); else $product->qty= 1;
        if ($product->quantity >=  $product->qty) {
            if ($order=order::hasOrderInCart($loguser->iduser)) {
                if (order::isInOrder($product->idproduct,$order->idorder)) {
                    if (@$order->removeProduct($product)) {
                        @$order->addProduct($product);
                    };
                }
                else{
                    @$order->addProduct($product);
                }
            }
            else {
                $order = order::createobj($loguser->iduser);
                $order->insert();
                $order=order::selectCart($loguser->iduser);
                @$order->addProduct($product);
            }
        }
    }
    header('Location: '.$_SERVER['HTTP_REFERER']);
}
else {
    header("Location: signin.php?error=Sorry You need to login ");
}
 ?>
