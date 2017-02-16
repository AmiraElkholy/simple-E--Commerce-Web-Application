<?php
class user{
    private $iduser;
    private $email;
    private $password;
    private $name;
	private $birthdate;
	private $job;
	private $address;
	private $creditlimit;
	private $isadmin;
	private $isdeleted;
    private $userinterests;


    function __get($name){
        return $this->$name;
    }

    function __set($name,$value){
        $this->$name = $value;
    }

    function isvalidemail($email) {
        $exists = $this->selectbyemail($email);
        if($exists)
            return false;
        else
            return true;
    }

    function insert() {
        require 'config.php';

        $query = "insert into user(email, password, name, birthdate, job, address, creditlimit) values(?,?,?,?,?,?,?)";

        $stmt = $mysqli->prepare($query);

        if(!$stmt) {
            echo "preparation failed ".$mysqli->errno." : ".$mysqli->error."<br>";
        }

        $email = $this->email;
        $password = $this->password;
        $name = $this->name;
        $birthdate = $this->birthdate;
        $job = $this->job;
        $address = $this->address;
        $creditlimit = $this->creditlimit;
        $userinterests = $this->userinterests;

        $stmt->bind_param('ssssssi', $email, $password, $name, $birthdate, $job, $address, $creditlimit);

        $stmt->execute();

        if($stmt->affected_rows > 0) {
            $this->iduser=$stmt->insert_id;
            $this->isadmin = 0; //isadmin??
            $this->isdeleted = 0;

            foreach ($userinterests as $interest) {
                $userinterest = new interest();
                $userinterest->iduser = $stmt->insert_id;
                $userinterest->idcategory = intval($interest);

                $state = $userinterest->insert();

                if(!$state) {
                    //rollback transaction
                    return false;
                }
            }
            return $this;
        }
        else {
            return false;
        }
    }

    function delete() {
        require 'config.php';

        $query = "update user set isdeleted = 1 where iduser = ? and isdeleted != 1 and name != 'admin'";

        $stmt = $mysqli->prepare($query);

        $iduser = $this->iduser;

        $stmt->bind_param('i', $iduser);

        $stmt->execute();

        if(!$stmt){
            echo "preparation failed ".$mysqli->errno." : ".$mysqli->error."<br>";
        }

        if($stmt->affected_rows > 0) {
            return true;
        }
        else {
            return false;
        }
    }

    function selectbyid($iduser) {
        require 'config.php';

        $query = "select * from user where iduser = ? and isdeleted != 1";

        $stmt = $mysqli->prepare($query);

        $stmt->bind_param('i', $iduser);

        $stmt->execute();

        if(!$stmt) {
            echo "preparation failed ".$mysqli->errno." : ".$mysqli->error."<br>";
        }

        $result = $stmt->get_result();
        $obj = $result->fetch_object();

        if($obj) {
            $this->iduser = $obj->iduser;
            $this->name = $obj->name;
            $this->email = $obj->email;
            $this->password = $obj->password;
            $this->birthdate = $obj->birthdate;
            $this->job = $obj->job;
            $this->address = $obj->address;
            $this->creditlimit = $obj->creditlimit;
            $this->isadmin = $obj->isadmin;
            $this->isdeleted = $obj->isdeleted;
            return $this;
        }
        else {
            return false;
        }
    }

    function selectbyemail($email) {
        require 'config.php';

        $query = "select * from user where email = ? and isdeleted != 1";

        $stmt = $mysqli->prepare($query);

        $stmt->bind_param('s', $email);

        $stmt->execute();

        if(!$stmt) {
            echo "preparation failed ".$mysqli->errno." : ".$mysqli->error."<br>";
        }

        $result = $stmt->get_result();
        $obj = $result->fetch_object();

        if($obj) {
            $this->iduser = $obj->iduser;
            $this->name = $obj->name;
            $this->email = $obj->email;
            $this->password = $obj->password;
            $this->birthdate = $obj->birthdate;
            $this->job = $obj->job;
            $this->address = $obj->address;
            $this->creditlimit = $obj->creditlimit;
            $this->isadmin = $obj->isadmin;
            $this->isdeleted = $obj->isdeleted;
            return $this;
        }
        else {
            return false;
        }
    }

    function update() {
        require 'config.php';

        $query = "update user set name=?, email=?, password=?, birthdate=?, job=?, address=?, creditlimit=? where iduser=? and isdeleted != 1";

        $stmt = $mysqli->prepare($query);

        $iduser = $this->iduser;
        $name = $this->name;
        $email = $this->email;
        $password = $this->password;
        $birthdate = $this->birthdate;
        $job = $this->job;
        $address = $this->address;
        $creditlimit = $this->creditlimit;


        $stmt->bind_param('sssssssi', $name, $email, $password, $birthdate, $job, $address, $creditlimit, $iduser);

        $stmt->execute();

        // $query = "select * from users where id = ?";
        // $stmt = $mysqli->prepare($query);
        // $stmt->bind_param('i', $id);
        // $stmt->execute();
        // $result = $stmt->get_result();
        // $obj = $result->fetch_object();


        if($stmt->affected_rows > 0) {
            return $this;
        }
        else {
            return false;
        }
    }

    function selectAll() {
        require 'config.php';

        $query = "select * from user where isdeleted != 1";
        $stmt = $mysqli->prepare($query);

        if(!$stmt){
            echo "preparation failed ".$mysqli->errno." : ".$mysqli->error."<br>";
        }

        $stmt->execute();

        $result = $stmt->get_result();

        $users = [];
        if($result) {
            while($obj = $result->fetch_object()) {
                array_push($users, $obj);
            }
            return $users;
        }
        else {
            return false;
        }
    }

    function login() {
        require 'config.php';

        $query = "select * from user where email = ? and password = ? and isdeleted != 1";

        $stmt = $mysqli->prepare($query);
        if(!$stmt) {
            echo "preparation failed ".$mysqli->errno." : ".$mysqli->error."<br>";
        }

        $email = $this->email;
        $password =  $this->password;

        $stmt->bind_param('ss', $email, $password);

        $stmt->execute();

        $result = $stmt->get_result();
        $obj = $result->fetch_object('user');

        if($obj) {
            $this->iduser = $obj->iduser;
            $this->name = $obj->name;
            $this->email = $obj->email;
            $this->password = $obj->password;
            $this->birthdate = $obj->birthdate;
            $this->job = $obj->job;
            $this->address = $obj->address;
            $this->creditlimit = $obj->creditlimit;
            $this->isadmin = $obj->isadmin;
            $this->isdeleted = $obj->isdeleted;
            return $this;
        }
        else {
            return false;
        }
    }


    public static function getInterestsList() {
        $cat = new category();
        $interests = $cat->selectind();
        return $interests;
    }



}

 ?>
