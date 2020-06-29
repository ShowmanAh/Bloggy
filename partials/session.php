<?php
// start session
session_start();
// ERROR MESSAGE
function Message() {
	if (isset($_SESSION["ErrorMessage"])) {
		$output="<div class=\"alert alert-danger\">";
		$output.=htmlentities($_SESSION["ErrorMessage"]);
		$output.="</div>";
		$_SESSION["ErrorMessage"]=null;
		return $output;

	}
}
// SUCCESS MESSAGE
function SuccessMessage() {
	if (isset($_SESSION["SuccessMessage"])) {
		$output="<div class=\"alert alert-Success\">";
		$output.=htmlentities($_SESSION["SuccessMessage"]);
		$output.="</div>";
		$_SESSION["SuccessMessage"]=null;
		return $output;

	}
}
function login(){
    if($_SESSION['id']){
        return true;
    }
}
function confirmLogin(){
    if(!login ()){
        echo 'login required';
        header ("location:login.php");
    }
}
?>