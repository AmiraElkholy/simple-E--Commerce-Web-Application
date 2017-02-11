<?php
class product{
    private $idproduct;
    private $name;
    private $price;
    private $quantity;
    private $description;
    private $image;
    private $idcategory;
    private $isdeleted;
//=======================================================================================================
    function __get($attr){
        return $this->$attr;
    }
    function __set($attr,$value){
        $this->$attr = $value; //variable variable
    }
    static function createobj($name,$price,$quantity,$description,$image,$idcategory){
        $obj=new self();
        $obj->idproduct=null;
        $obj->name=$name;
        $obj->price=$price;
        $obj->quantity=$quantity;
        $obj->description=$description;
        $obj->image=$image;
        $obj->idcategory=$idcategory;
        $obj->isdeleted=0;
        return $obj;
    }
    static function selectAll() {
        require 'config.php';
        $stmt = $mysqli->prepare("SELECT * FROM `E-Commerce`.product");
        $stmt->execute();
        $result = $stmt->get_result();
        while($obj = $result->fetch_object('product')) {
            $products[]=$obj;
        }
        return $products;
    }
    static function selectbyname($name) {
        require 'config.php';
        $stmt = $mysqli->prepare("SELECT * FROM `E-Commerce`.product WHERE `name` = ?");
        $stmt->bind_param('s', $name);
        $stmt->execute();
        $result = $stmt->get_result();
        while($obj = $result->fetch_object('product')) {
            $products[]=$obj;
        }
        return $products;
    }
    static function selectbyid($idproduct) {
        require 'config.php';
        $stmt = $mysqli->prepare("SELECT * FROM `E-Commerce`.product WHERE `idproduct` = ?");
        $stmt->bind_param('i', $idproduct);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_object('product');
    }
    function insert() {
        require 'config.php';
        $stmt = $mysqli->prepare("INSERT INTO `E-Commerce`.`product` VALUES(null,?,?,?,?,?,?,?)");
        $stmt->bind_param('sdissii',$this->name,$this->price,$this->quantity,$this->description,$this->image,$this->idcategory,$this->isdeleted);
        return $stmt->execute();
    }
    function update() {
        require 'config.php';
        $stmt = $mysqli->prepare("UPDATE `E-Commerce`.`product`
            SET
            `name` = ?,
            `price` = ?,
            `quantity` = ?,
            `description` = ?,
            `image` = ?,
            `idcategory` = ?,
            `isdeleted` = ?
            WHERE `idproduct` = $this->idproduct
            ");
        $stmt->bind_param('sdissii',$this->name,$this->price,$this->quantity,$this->description,$this->image,$this->idcategory,$this->isdeleted);
        return $stmt->execute();
    }
}?>
