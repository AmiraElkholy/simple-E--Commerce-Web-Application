<?php
class order
{
    private $idorder;
    private $date;
    private $iduser;
    private $isdeleted;
    private $products=[];
    //=======================================================================================================
    function __get($attr){
        return $this->$attr;
    }
    function __set($attr,$value){
        $this->$attr = $value; //variable variable
    }
    public static function createobj($iduser,$products){
        $obj = new self();
        $obj->idorder=null;
        // $obj->date=date('Y-m-d H:i:s');
        $obj->iduser=$idusr;
        $obj->products=$products;
        $obj->isdeleted=0;
        return $obj;
    }
    static function selectAll() {
        require 'config.php';
        $stmt = $mysqli->prepare("SELECT * FROM `E-Commerce`.order WHERE isdeleted = 0");
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
            WHERE `idorder` = ? AND isdeleted = 0");
        $stmt->bind_param('i', $idorder);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_object('order');
    }
    function insert() {
        require 'config.php';
        $stmt = $mysqli->prepare("INSERT INTO `E-Commerce`.`order`
        VALUES(null,null,?,null)");
        $stmt->bind_param('i',$this->iduser);
        return $stmt->execute();
    }
    function addProducts(){
        require 'config.php';
        $stmt = $mysqli->prepare("INSERT INTO `E-Commerce`.`orderproduct`
        VALUES(?,?,?,?)");
        foreach ($products as $value) {
            $stmt->bind_param('iidi',$this->idorder,$value->idproduct,
                $value->price,$value->orderQuantity);
            $stmt->execute();
        }
    }
    //Still working on
    function getProducts(){
        require 'config.php';
        $stmt = $mysqli->prepare("SELECT * FROM `E-Commerce`.orderproduct WHERE idorder = $this->idorder");
        $stmt->execute();
        $result = $stmt->get_result();
        while($obj = $result->fetch_obj()) {
            $products[]=$obj;
        }
        return $products;
    }
}

 ?>
