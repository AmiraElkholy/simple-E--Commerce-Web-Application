<?php
    if (isset($_POST['category'])) {
        require "auto_load.php";
        $cat=new category();
        $cat->name=$_POST['category'];
        if($cat->insert()){
            header('Location:catmanagement.php?message=Category Added Successfully');
        }
        else{
            header('Location:catmanagement.php?error=Failed to Add Category');
        }
    }
?>
