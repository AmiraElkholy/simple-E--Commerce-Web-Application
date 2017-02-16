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
    static function selectCart($iduser){
        require 'config.php';
        $stmt = $mysqli->prepare("SELECT * FROM `E-Commerce`.order
            WHERE `iduser` = ? AND isdeleted = 0 AND iscart = 1");
        $stmt->bind_param('i', $iduser);
        $stmt->execute();
        $result = $stmt->get_result();
        $obj=$result->fetch_object('order');
        return $obj;
    }
    //=======================================================================================================
    static function hasOrderInCart($iduser){
        require 'config.php';
        $stmt = $mysqli->prepare("SELECT * FROM `E-Commerce`.order
            WHERE `iduser` = ? AND isdeleted = 0 AND iscart = 1");
        $stmt->bind_param('i', $iduser);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $order=$result->fetch_object('order');
            return $order;
        }
        else return false;
    }
    static function isInOrder($idproduct,$idorder){
        require 'config.php';
        $stmt= $mysqli->prepare("SELECT * FROM `E-Commerce`.orderproduct
            WHERE idorder=? AND idproduct=?");
        $stmt->bind_param('ii',$idorder,$idproduct);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_object();
    }
    static function hasThisInCart($idproduct,$iduser){
        if (order::hasOrderInCart($iduser)) {
            if (order::isInOrder($idproduct)) {
                return true;
            }
        }
        return false;
    }
    //=======================================================================================================
    function insert() {
        require 'config.php';
        $stmt = $mysqli->prepare("INSERT INTO `E-Commerce`.`order`(`iduser`)VALUES(?)");
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
    function setProducts(){
        require 'config.php';
        $stmt = $mysqli->prepare("SELECT * FROM `E-Commerce`.orderproduct WHERE idorder = $this->idorder");
        $stmt->execute();
        $result = $stmt->get_result();
        while($obj = $result->fetch_object()) {
            $this->products[]=$obj;
        }
    }
    //=======================================================================================================
    function checkout($loguser){
        $total=$this->calcTotAmount();
        if ($total > $loguser->creditlimit) {
            return false;
        }
        foreach ($this->products as $key => $value) {
            var_dump($value);
            product::selectbyid($value->idproduct)->quantity -= $value->quantity;
        }
    }
    function calcTotAmount(){
        $total=0;
        foreach ($this->products as $key => $value) {
            $product= product::selectbyid($value->idproduct);
            $total+=($value->unitprice * $value->quantity);
        }
        return $total;
    }
    //=======================================================================================================
}

 ?>
