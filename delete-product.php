<?php
    require_once 'isadmin.php';
    if (isset($_GET['productname'])) {
        $product=product::selectbyname($_GET['productname']);
        if ($product->delete()) {
            echo "success";
        }
        else {
            echo "fail";
        }
    }

 ?>
