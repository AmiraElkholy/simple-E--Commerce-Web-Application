<?php
    require_once 'isadmin.php';
    if (isset($_GET['name'])) {
        $product=product::selectbyname($_GET['name']);
        if ($product->delete()) {
            header("Location: prodmanagement.php?message=Product Deleted Successfully");
        }
        else {
            header("Location: prodmanagement.php?error=failed to delete product");
        }
    }

 ?>
