<?php
require 'Classes/Comment.php';
require 'partials/session.php';
require  'partials/direction.php';
confirmLogin ();
$comment = new Comment();

if(isset($_GET['id'])){
    $approveComment = $comment->approveComment ($_GET['id']);
    if ($approveComment){
        $_SESSION['SuccessMessage'] = 'Comment Approved successfully';
        Redirect_to ('comments.php');

    }else{
        Redirect_to ('comments.php');
    }
}

