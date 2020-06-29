<?php
// include file
require 'DB_Config.php';
require 'MysqlAdapter.php';
class Admins extends MysqlAdapter{
    private $table = 'users';

    public function __construct()
    {
        global $config;
        parent::__construct ($config);
    }
    // function get all users
    public function getUsers(){
        $query = "SELECT * FROM  $this->table  ORDER BY created_at desc ";
        $this->query ($query);
        return $this->fetchAll ();
    }
    public function addUser($name,$email,$avatar,$password,$admin){
        $query = "INSERT INTO users(name,email,avatar,password,admin) values('" .$name. "', '" .$email."','" .$avatar."','".$password."',".$admin.")";
        $this->query ($query);
        return $this->getInsertedId ();

    }
    public function getEmail($email){
        $query = "SELECT * FROM $this->table WHERE email = '".$email."'";
        $result = $this->query ($query);
        return mysqli_num_rows($result);
        //return $this->countRow ();
    }
    // function search users by keyword
    public function searchUsers($keyword){
        $query = "SELECT * FROM $this->table";
        $query .= " WHERE name LIKE '%".$keyword."%' || email LIKE '%".$keyword."%'";
        $this->query ($query);
        return $this->fetchAll();
    }
    //Function  DELETE USER
    public function deleteUser($userId){
        $query = " DELETE FROM $this->table WHERE id = '$userId'";
         $this->query ($query);
         return $this->affectedRow ();
    }
    // Function login user
    public function loginUser($email){
        $query = "SELECT * FROM users WHERE email='".$email."' LIMIT 1";
        $excute = $this->query ($query);
        //return $this->fetch ();
        $result = mysqli_fetch_assoc ($excute);
        return $result;

    }



// function make logout
public function logout(){
        session_start ();
        $_SESSION = [];
        session_destroy ();
}


}
