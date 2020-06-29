<?php
require 'Classes/Comment.php';
require 'partials/session.php';
require  'partials/direction.php';
confirmLogin ();
$comment = new Comment();

if(isset($_GET['id'])){
    $disapproveComment = $comment->disapproveComment ($_GET['id']);
    if ($disapproveComment){
        $_SESSION['SuccessMessage'] = 'Comment disapproved successfully';
        Redirect_to ('comments.php');

    }else{
        Redirect_to ('comments.php');

    }
}

