<?php
    require_once 'isuser.php';
    if(!$loguser) {
        header('Location: signin.php?error=you are not logged in, please log in first');
        exit;
    }
    $cart=order::selectCart($loguser->iduser);
    $cart->setProducts();
    $cart->checkout($loguser);
//=================================================================================
 ?>
