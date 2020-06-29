<?php
require 'DB_Config.php';
require 'MysqlAdapter.php';
class Category extends MysqlAdapter{
    private $table = 'categories';
    public function __construct()
    {
        global $config;
        parent::__construct ($config);
    }
    //Function  get all categories
public function getCategories(){
        $query = "SELECT * FROM $this->table ORDER BY created_at";
        $this->query ($query);
        return $this->fetchAll ();
}
// Function ADD NEW CATEGORY
public function addCategory($name, $creator){
        $query = "INSERT INTO $this->table(name,creater) VALUES ('" .$name."','" .$creator."')";
        $this->query($query);
        return $this->getInsertedId ();

}
// Function Delete Category
public function deleteCategory($category_id){
        $query = "DELETE FROM $this->table where id = '$category_id'";
        $this->query ($query);
        $this->affectedRow ();
}
// Function get category by id
public function getCategoryById($id){
        $query = "SELECT * FROM $this->table where id = '$id' LIMIT 1";
        $this->query ($query);
        return $this->fetch ();
}
// Function Update Category
public function updateCategory($name, $creator, $id){
        //$query = "UPDATE $this->table SET name = '".$name."', creater = ".$creator." WHERE id = '".$id."'";
      $query = "UPDATE $this->table SET name = '$name', creater = '$creator' WHERE id = $id";
        $this->query ($query);
        return $this->affectedRow ();

}


}