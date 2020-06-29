<?php
require 'Classes/Category.php';
require 'partials/session.php';
require 'partials/direction.php';
confirmLogin ();
$category = new Category();
if(isset($_GET['id'])){
    $category_id = $_GET['id'];
   $category->deleteCategory ($category_id);
       $_SESSION['SuccessMessage'] = 'category deleted successfully';
       Redirect_to ('categories.php');

}
