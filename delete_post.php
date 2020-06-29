<?php
require 'partials/session.php';
require 'Classes/Post.php';
require 'partials/direction.php';
confirmLogin ();
$post = new Post();
if (isset($_GET['id'])){
    $deletePost = $post->deletePost ($_GET['id']);
    if ($deletePost){
        $_SESSION["SuccessMessage"]="post Deleted Successfuly";
        Redirect_to("Dashboard.php");

    }else{
        Redirect_to ('Dashboard.php');
    }
}