<?php
require_once('isuser.php');

if ($loguser) {
    if (isset($_GET['name'])) {
        if($product=product::selectbyname($_GET['name'])){
            if (isset($_GET['qty'])) {
                $product->qty=intval($_GET['qty']);
            }
            else {
                $product->qty= 1;
            }
            print_r($product);
            $order = order::createobj($loguser->iduser);
            if($order->addProduct($product)) echo "Done";
            else echo "error";
        }
    }
}
else {
    header("Location: signin.php?error=Sorry You need to login ");
}
 ?>
