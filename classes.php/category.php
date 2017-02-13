<?php
class category{
    private $idcategory;
    private $name;
    private $idsupercategory;
    private $isdeleted;

    function __get($name){
        return $this->$name;
    }

    function __set($name,$value){
        $this->$name = $value;
    }

    //CRUD
    // 1. Create (INSERT):
    function insert(){
        require 'config.php';
        $query="insert into category(name,idsupercategory) values(?,?)";
        $stmt=$mysqli->prepare($query);
        $stmt->bind_param('si',$this->name,$this->idsupercategory);
        return $stmt->execute();
        $stmt->close();
        $mysqli->close();
    }

    // 2. Read (SELECT):
    // (a) Select By category id (idcategory):
    function selectcatbyid($id){
        require 'config.php';
        $query="select * from category where idcategory=? and isdeleted != 1";
        $stmt=$mysqli->prepare($query);
        $stmt->bind_param('i',$id);
        $stmt->execute();
        if(!$stmt){
            echo "preparation failed ".$mysqli->errno." : ".$mysqli->error."<br>";
            exit();
        }
        $result = $stmt->get_result();
        $categories=[];
        if($result) {
            while($obj = $result->fetch_object()) {
                array_push($categories, $obj);
            }
            return $categories;
        }
        else {
            return false;
        }
        $stmt->close();
        $mysqli->close();
    }

    // (b) Select By supercategory id (idsupercategory):
    function selectcatbysupid($id){
        require 'config.php';
        $query="select * from category where idsupercategory=? and isdeleted != 1";
        $stmt=$mysqli->prepare($query);
        $stmt->bind_param('i',$id);
        $stmt->execute();
        if(!$stmt){
            echo "preparation failed ".$mysqli->errno." : ".$mysqli->error."<br>";
            exit();
        }
        $result = $stmt->get_result();
        $categories=[];
        if($result) {
            while($obj = $result->fetch_object()) {
                array_push($categories, $obj);
            }
            return $categories;
        }
        else {
            return false;
        }
        $stmt->close();
        $mysqli->close();
    }

    // (c) Select All
    function selectall(){
        require 'config.php';
        $query="select * from category where isdeleted != 1";
        $stmt=$mysqli->prepare($query);
        $stmt->execute();
        if(!$stmt){
            echo "preparation failed ".$mysqli->errno." : ".$mysqli->error."<br>";
            exit();
        }
        $result = $stmt->get_result();
        $categories=[];
        if($result) {
            while($obj = $result->fetch_object()) {
                array_push($categories, $obj);
            }
            return $categories;
        }
        else {
            return false;
        }
        $stmt->close();
        $mysqli->close();
    }

    // (d) Select Super Categories
    function selectsup(){
        require 'config.php';
        $query="select * from category where idcategory in(select idsupercategory from category where idsupercategory is NOT NULL) and isdeleted!=1";
        $stmt=$mysqli->prepare($query);
        $stmt->execute();
        if(!$stmt){
            echo "preparation failed ".$mysqli->errno." : ".$mysqli->error."<br>";
            exit();
        }
        $result = $stmt->get_result();
        $categories=[];
        if($result) {
            while($obj = $result->fetch_object()) {
                array_push($categories, $obj);
            }
            return $categories;
        }
        else {
            return false;
        }
        $stmt->close();
        $mysqli->close();
    }

    // 3. Update (UPDATE):
    function update(){
        require 'config.php';
        $query="update category set name=?, idsupercategory=? where idcategory=?";
        $stmt=$mysqli->prepare($query);
        $idcategory=$this->idcategory;
        $name=$this->name;
        $idsupercategory=$this->idsupercategory;
        $stmt->bind_param('sii',$name,$idsupercategory,$idcategory);
        return $stmt->execute();
        $stmt->close();
        $mysqli->close();
    }

     // 4. Soft Delete (DELETE):
     function delete(){
        require 'config.php';
        $query="update category set isdeleted=1 where idcategory = ? and isdeleted != 1 ";
        $stmt=$mysqli->prepare($query);
        $idcategory=$this->idcategory;
        $stmt->bind_param('i',$idcategory);
        $stmt->execute();
        if(!$stmt){
            echo "preparation failed ".$mysqli->errno." : ".$mysqli->error."<br>";
            exit();
        }
        if($stmt->affected_rows>0){
            echo "Category was successfully deleted";
            return true;
        }
        else{
            echo "Category delete failed";
            return false;
            exit();
        }
        $stmt->close();
        $mysqli->close();
    }
}

?>
