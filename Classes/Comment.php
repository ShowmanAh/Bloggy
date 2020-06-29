<?php
require 'DB_Config.php';
require 'MysqlAdapter.php';
class Comment extends MysqlAdapter
{
    private $table = 'comments';
    private $table2 = 'posts';
    public function __construct()
    {
        global $config;
        parent::__construct ($config);
    }
    // function get un approve comment
public function getUNApprovedComment(){
        $query = "SELECT * FROM $this->table WHERE status = 0 ORDER BY created_at desc";
        $this->query ($query);
        return $this->fetchAll ();
}
// function get Approve Comment
    public function getApprovedComment(){
        $query = "SELECT * FROM $this->table WHERE status = 1 ORDER BY created_at desc";
        $this->query ($query);
        return $this->fetchAll ();
    }
    // function Update approve comment
    public function approveComment($id){
        $query = "UPDATE $this->table SET status = 1 WHERE id = '$id'";
        $this->query($query);
        return $this->affectedRow ();

    }
    // function update dis approve comment
    public function disapproveComment($id){
        $query = "UPDATE $this->table SET status = 0 WHERE id = '$id'";
        $this->query($query);
        return $this->affectedRow ();

    }
    // function get number un approve comment
    public function countOffComments(){
        $query = "SELECT COUNT(*) FROM $this->table WHERE status = 0";
        $this->query ($query);
        return $this->fetch ();
    }
    // function get number approve comment in post
    public function count_Comments_ON_post($id){
        $query = "SELECT COUNT(*) FROM $this->table WHERE status = 1 AND post_id = '$id'";
        $this->query ($query);
        return $this->fetch ();
    }
    // function get number un approve comment in post 
    public function count_Comments_OFF_post($id){
        $query = "SELECT COUNT(*) FROM $this->table WHERE status = 0 AND post_id = '$id'";
        $this->query ($query);
        return $this->fetch ();
    }
    // function delete comment
   public function deleteComment($id){
        $query = "DELETE FROM $this->table WHERE id = '$id'";
        $this->query ($query);
        return $this->affectedRow ();
}

  
    public function getPosts(){
        $query = "SELECT * FROM $this->table2 ORDER BY created_at desc";
        $this->query ($query);
        return $this->fetchAll ();
    }

}