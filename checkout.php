<?php
    require_once 'isuser.php';
    if(!$loguser) {
        header('Location: signin.php?error=you are not logged in, please log in first');
        exit;
    }
    $cart=order::selectCart($loguser->iduser);
    $cart->setProducts();
    if ($cart->checkout($loguser)) {
        header("Location: shopping-cart.php?message=Checked Out Successfully");
    }
    else {
        header("Location: shopping-cart.php?error=Error while Checking out please review your credit");
    }

//=================================================================================
 ?>
