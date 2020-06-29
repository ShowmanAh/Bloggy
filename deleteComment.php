<?php
require 'Classes/Comment.php';
require 'partials/session.php';
require 'partials/direction.php';
confirmLogin ();
$comment = new Comment();
if(isset($_GET['id'])){
    $deleteComment = $comment->deleteComment ($_GET['id']);
    if($deleteComment){
        $_SESSION['SuccessMessage'] = 'Comment Deleted Successfully';
        Redirect_to ('comments.php');
    }else{
        Redirect_to ('comments.php');
    }
}