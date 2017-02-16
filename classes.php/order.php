<?php
class order
{
    private $idorder;
    private $date;
    private $iduser;
    private $isdeleted;
    private $iscart;
    private $products=[];
    //=======================================================================================================
    function __get($attr){
        return $this->$attr;
    }
    function __set($attr,$value){
        $this->$attr = $value; //variable variable
    }
    public static function createobj($iduser){
        $obj = new self();
        $obj->idorder=null;
        // $obj->date=date('Y-m-d H:i:s');
        $obj->iduser=$iduser;
        $obj->isdeleted=0;
        $obj->iscart=1;
        return $obj;
    }
    static function selectAll() {
        require 'config.php';
        $stmt = $mysqli->prepare("SELECT * FROM `E-Commerce`.order WHERE isdeleted = 0 AND iscart = 0");
        $stmt->execute();
        $result = $stmt->get_result();
        while($obj = $result->fetch_object('order')) {
            $orders[]=$obj;
        }
        return $orders;
    }
    static function selectbyid($idorder) {
        require 'config.php';
        $stmt = $mysqli->prepare("SELECT * FROM `E-Commerce`.order
            WHERE `idorder` = ? AND isdeleted = 0 AND iscart = 0");
        $stmt->bind_param('i', $idorder);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_object('order');
    }
    static function selectbyUserid($iduser){
        require 'config.php';
        $stmt = $mysqli->prepare("SELECT * FROM `E-Commerce`.order
            WHERE `iduser` = ? AND isdeleted = 0 AND iscart = 0");
        $stmt->bind_param('i', $iduser);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($obj=$result->fetch_object('order')) {
            $orders[]=$obj;
        }
        return $orders;
    }
    function insert() {
        require 'config.php';
        $stmt = $mysqli->prepare("INSERT INTO `E-Commerce`.`order`
        VALUES(null,null,?,null,null)");
        $stmt->bind_param('i',$this->iduser);
        return $stmt->execute();
    }
    function addProduct($product){
        require 'config.php';
        $stmt = $mysqli->prepare("INSERT INTO `E-Commerce`.`orderproduct`
        VALUES(?,?,?,?)");
        $stmt->bind_param('iidi',$this->idorder,$product->idproduct,
            $product->price,$product->qty);
        if($stmt->execute()){
            $this->products[]=$product;
            return true;
        }
        else return false;
    }
    function removeProduct($product){
        require 'config.php';
        $stmt = $mysqli->prepare("DELETE FROM `E-Commerce`.`orderproduct`
        WHERE idorder=$this->idorder AND idproduct=$product->idproduct");
        return $stmt->execute();
    }
    function getProducts(){
        require 'config.php';
        $stmt = $mysqli->prepare("SELECT * FROM `E-Commerce`.orderproduct WHERE idorder = $this->idorder");
        $stmt->execute();
        $result = $stmt->get_result();
        while($obj = $result->fetch_obj()) {
            $this->products[]=$obj;
        }
        return $products;
    }

}

 ?>
