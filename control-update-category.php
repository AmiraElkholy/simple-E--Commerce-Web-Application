<?php
    if (isset($_POST)) {
        require "auto_load.php";
        $cat=new category();
        $cat->name=$_POST['name'];
        $cat->idcategory=$_POST['id'];
        if(is_numeric($_POST['super'])){
            $cat->idsupercategory=$_POST['super'];
        }
        if($cat->update()){
            header('Location:catmanagement.php');
        }
        else{
            header('Location:catmanagement.php');
        }
    }
?>