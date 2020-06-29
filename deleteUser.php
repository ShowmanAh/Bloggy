<?php
require 'Classes/Admins.php';
require 'partials/session.php';
require 'partials/direction.php';
// check authenticate
confirmLogin ();
$user = new Admins();
if (isset($_GET['id'])){
    $user_id = $_GET['id'];
    $deleteUser = $user->deleteUser ($user_id);
    if($deleteUser){
        $_SESSION['SuccessMessage'] = 'user delete successfully';
        Redirect_to ('admins.php');
    }else{
        Redirect_to ('admins.php');
    }
}
