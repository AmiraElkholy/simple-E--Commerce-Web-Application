<?php 
class interest {
	private $iduser;
	private $idcategory;

	function __get($name){
        return $this->$name;
    }

    function __set($name,$value){
        $this->$name = $value;
    }

	function insert() {
		require('config.php');

		$q = "insert into interest(iduser, idcategory) values(?,?)";
        $s = $mysqli->prepare($q);

        if(!$s) {
            echo "preparation failed ".$mysqli->errno." : ".$mysqli->error."<br>";
        }        

        $iduser = $this->iduser;
        $idcategory = $this->idcategory;

        $s->bind_param('ii',$iduser,$idcategory);


        if(!$s->execute()) {
            echo "execution failed ".$mysqli->errno." : ".$mysqli->error."<br>";
        }

        if($s->affected_rows > 0) {
            return true;
        }
        else {
            return false;
        }
	}

	function selectuserinterests() {
		require('config.php');

		$q = "select * from interest where iduser = ?";
        $s = $mysqli->prepare($q);

        if(!$s) {
            echo "preparation failed ".$mysqli->errno." : ".$mysqli->error."<br>";
        }        

        $iduser = $this->iduser;

        $s->bind_param('i',$iduser);

        if(!$s->execute()) {
            echo "execution failed ".$mysqli->errno." : ".$mysqli->error."<br>";
        }

        $result = $s->get_result();

        $interests = [];
        if($result) {
            while($obj = $result->fetch_object()) {
                array_push($interests, $obj);
            }
            return $interests;
        }
        else {
            return false;
        }

        if($s->affected_rows > 0) {
            return true;
        }
        else {
            return false;
        }		
	}



}

?>