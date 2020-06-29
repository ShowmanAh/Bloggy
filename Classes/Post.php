<?php
require 'DB_Config.php';
require 'MysqlAdapter.php';
class Post extends MysqlAdapter
{
    private $table = 'posts';
    private $table2 = 'categories';
    public function __construct()
    {
        global $config;
        parent::__construct ($config);
    }
    // function get all posts
 public function getPosts(){
        $query = "SELECT * FROM $this->table ORDER BY created_at desc ";
        $this->query ($query);
        return $this->fetchAll ();
 }
 // Function get all categories
    public function getCategories(){
        $query = "SELECT * FROM $this->table2 ORDER BY created_at";
        $this->query ($query);
        return $this->fetchAll ();
    }
    // Function ADD POST
    public function addPost($title, $category, $author, $avatar, $description){
        $query = "INSERT INTO $this->table(title, category, author, image, describtion) VALUES('".$title."', '".$category."', '".$author."', '".$avatar."', '".$description."')";
        $this->query($query);
        return $this->getInsertedId ();

    }
    // function get post by id
    public function getPostById($id){
        $query = "SELECT * FROM $this->table where id = '$id' LIMIT 1";
        $this->query ($query);
        return $this->fetch ();
    }
    // FUNCTION SEARCH POST WITH KEYWORD
 public function searchPost($keyword){
     $query = "SELECT * FROM $this->table ";
     $query .= " WHERE title LIKE '%".$keyword."%' OR category LIKE '%".$keyword."%'";
     $this->query ($query);
     return $this->fetchAll ();
 }
 // FUNCTION UPDATE POST
    public function updatePost($title, $category, $author, $avatar, $description, $id){
        //$query = "UPDATE $this->table SET name = '".$name."', creater = ".$creator." WHERE id = '".$id."'";
        $query = "UPDATE $this->table SET title = '$title', category = '$category', author = '$author', image = '$avatar', describtion = '$description' WHERE id = $id";
        $this->query ($query);
        return $this->affectedRow ();

    }
    // FUNCTION DELETE POST
 public function deletePost($post_id){
        $query = "DELETE FROM $this->table WHERE id = '$post_id'";
        $this->query ($query);
        return $this->affectedRow ();
 }

}