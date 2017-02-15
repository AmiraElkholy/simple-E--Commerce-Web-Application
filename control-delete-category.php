 <?php
    require_once 'auto_load.php';
    $cat=new category();
    $cat->idcategory=$_GET['id'];
    if($cat->delete()){
        header('Location:catmanagement.php?message=Category Deleted Successfully');
    }
    else{
        header('Location:catmanagement.php?error=Failed to Delete Category');
    }
?>

