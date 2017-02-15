 <?php

require_once 'auto_load.php';
$cat=new category();
$cat->idcategory=$_GET['id'];
$cat->delete();
header('Location:catmanagement.php');
?>
