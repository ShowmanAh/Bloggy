<?php
require 'Classes/DB_Config.php';
require 'Classes/MysqlAdapter.php';

class Query extends MysqlAdapter
{
    private $category_table = 'categories';
    private $post_table = 'posts';
    private $comment_table = 'comments';
    public function __construct()
    {
        // configuration 
        global $config;
        parent::__construct ($config);
    }
    // function get comments on posts depends on status
    public function getComments($post_id){
        $query = "SELECT * FROM $this->comment_table WHERE status = 1 AND post_id = '$post_id'";
        $this->query ($query);
        return $this->fetchAll ();

    }
    // function search post by keywords
    public function searchPost($keyword){
        $query = "SELECT * FROM $this->post_table";
        $query .= " WHERE title LIKE '%".$keyword."%' || category LIKE '%".$keyword."%' || author LIKE '%".$keyword."%' || created_at LIKE '%".$keyword."%'";
        $this->query ($query);
        return $this->fetchAll();
    }
    // function adding comment on post
    public function add_comment($comment, $author, $id){
        $query = "INSERT INTO $this->comment_table(comment, author, post_id) VALUES ('".$comment."', '".$author."', '".$id."')";
        $this->query ($query);
        return $this->getInsertedId ();
    }
    // function get all categories
    public function get_Categories(){
        $query = "SELECT * FROM $this->category_table ORDER BY created_at";
        $this->query ($query);
        return $this->fetchAll ();
    }
    // function get post by id
    public function getPosts_ById($post_id){
        $query = "SELECT * FROM $this->post_table WHERE id = '$post_id' ORDER BY created_at desc ";
        $this->query ($query);
        return $this->fetchAll ();
    }
    // function get post by category
  public function getPostsByCategory($cat){
        $query = "SELECT * FROM $this->post_table WHERE category = '$cat' ORDER BY created_at desc";
         $this->query ($query);
         return $this->fetchAll ();
  }
  // function get post by page
public function getPostByPage($post_page){
        $query = "SELECT * FROM $this->post_table ORDER BY created_at desc LIMIT $post_page,5";
       $this->query ($query);
       return $this->fetchAll ();

}
// function get posts
public function getPost(){
        $query = "SELECT * FROM $this->post_table ORDER BY created_at desc LIMIT 0,3";
        $this->query ($query);
        return $this->fetchAll ();
}
// function get count comments on post
    public function count_Comments_ON_post($id){
        $query = "SELECT COUNT(*) FROM $this->comment_table WHERE status = 1 AND post_id = '$id'";
        $this->query ($query);
        return $this->fetch ();
    }
    // function get count posts
    public function count_Posts(){
        $query = "SELECT COUNT(*) FROM $this->post_table";
        $this->query ($query);
        return $this->fetch ();

    }
    public function getCategories(){
        $query = "SELECT * FROM $this->category_table ORDER BY created_at desc";
        $this->query ($query);
        return $this->fetchAll ();
    }
    // function get first 5 posts
    public function getPostLimit5(){
        $query = "SELECT * FROM $this->post_table ORDER BY created_at desc LIMIT 0,5";
        $this->query ($query);
        return $this->fetchAll ();
    }


}