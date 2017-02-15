<?php
    if (isset($_POST['category'])) {
        require "auto_load.php";
        $cat=new category();
        $cat->name=$_POST['category'];
        //$cat->idsupercategory=$_POST['id'];
        if($cat->insert()){
            header('Location:catmanagement.php');
        }
        else{
            header('Location:catmanagement.php');
        }
    }
?>