<?php
    if (isset($_POST)) {
        require "auto_load.php";
        $cat=new category();
        $cat->name=$_POST['subcategory'];
        $cat->idsupercategory=$_POST['id'];
        if($cat->insert()){
            header('Location:catmanagement.php?message=Subcategory Added Successfully');
        }
        else{
            header('Location:catmanagement.php?error=Failed to Add Subcategory');
        }
    }
?>
