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
//=======================================================================
    function __construct($name,$price,$quantity,$description,$image,$idcategory){
        $idproduct=null;
        $this->$name=$name;
        $this->$price=$price;
        $this->$quantity=$quantity;
        $this->$description=$description;
        $this->$image=$image;
        $this->$idcategory=$idcategory;
        $this->$isdeleted=0;
    }
    function __get($attr){
        return $this->$attr;
    }
    function __set($attr,$value){
        $this->$attr = $value; //variable variable
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
            `name` = <?>,
            `price` = <?>,
            `quantity` = <?>,
            `description` = <?>,
            `image` = <?>,
            `idcategory` = <?>,
            `isdeleted` = <?>
            WHERE `idproduct` = <$this->idproduct>
            ");
        $stmt->bind_param('sdissii',$this->name,$this->price,$this->quantity,$this->description,$this->image,$this->idcategory,$this->isdeleted);
        return $stmt->execute();
    }


//=======================================================================



    static function selectbyid($idproduct) {
        require 'config.php';
        $stmt = $mysqli->prepare("SELECT * FROM `E-Commerce`.product WHERE `idproduct` = <?>");
        $stmt->bind_param('i', $idproduct);
        $stmt->execute();
        $result = $stmt->get_result();
        return $obj = $result->fetch_object('product');
    }

    // function selectbyname($name) {
    //     require 'config.php';
    //     $query = "select * from users where username = ?";
    //     $stmt = $mysqli->prepare($query);
    //     $stmt->bind_param('s', $username);
    //     $stmt->execute();
    //     if(!$stmt) {
    //         echo "preparation failed ".$mysqli->errno." : ".$mysqli->error."<br>";
    //     }
    //     $result = $stmt->get_result();
    //     $obj = $result->fetch_object();
    //
    //     if($obj) {
    //         $this->id = $obj->id;
    //         $this->username = $obj->username;
    //         $this->pass = $obj->pass;
    //         $this->email = $obj->email;
    //         return $this;
    //     }
    //     else {
    //         return false;
    //     }
    // }

}

 ?>
