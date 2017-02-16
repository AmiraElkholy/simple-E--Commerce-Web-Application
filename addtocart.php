<?php
require_once('isuser.php');

if ($loguser) {
    if (isset($_GET['name'])) {
        if($product=product::selectbyname($_GET['name'])){
            if (isset($_GET['qty'])) $product->qty=intval($_GET['qty']);
            else $product->qty= 1;
            if ($order=order::hasOrderInCart($loguser->iduser)) {
                var_dump($order);
            }
            else {
                $order = order::createobj($loguser->iduser);
                if ($order->insert()){
                    if ($order->addProduct()) {
                        echo "product added to chart";
                    }
                    echo "failed to add to chart";
                }
            }

        }
    }
}
else {
    header("Location: signin.php?error=Sorry You need to login ");
}
 ?>
