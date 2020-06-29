<?php
require 'Classes/Admins.php';
require 'partials/direction.php';
$user = new Admins();
$user->logout ();
Redirect_to ('login.php');