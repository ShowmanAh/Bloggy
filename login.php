<?php
require 'Classes/Admins.php';
require 'partials/session.php';
require 'partials/direction.php';

$user = new Admins();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $link = $user->connect ();
    $email = mysqli_escape_string($link, $_POST['email']);
    $password = $_POST['password'];
    $foundUser = $user->loginUser ($email);
    if($foundUser){
        // attempt password
        $hashPassword = $foundUser['password'];
        if(password_verify ($password, $hashPassword)) {
            $_SESSION['id'] = $foundUser['id'];
            $_SESSION['email'] = $foundUser['email'];
            Redirect_to ('admins.php');
            exit();
        }else{
           // $error = "invalid email or password";
            $_SESSION['ErrorMessage'] = "invalid email or password";
        }
    }else{
        $_SESSION['ErrorMessage'] = "invalid email or password";
    }


}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    require 'partials/links.php';
    ?>
    <title>log in</title>
    <style>
        body{
            background-color: #ffffff;
        }
        .fieldinfo{
            color: orange;
            font-size: 1.2em;
        }
    </style>
</head>
<body>
<div class="container-fluid" style="margin-top: 70px;">
    <div class="row">

        <div class="col-sm-offset-4 col-sm-4">

            <?php echo Message (); ?>

            <div>
                <form method="post">
                    <fieldset>
                        <div class="form-group">
                            <label class="foo" for="email" class="fieldinfo" style="color: rgb(251, 174, 44); font-size: 1.2em;">Email:</label>
                            <div class="input-group input-group-lg">
									<span class="input-group-addon">
										<span class="glyphicon glyphicon-envelope text-primary"></span>
									</span>
                                <input class="form-control" type="email" name="email" id="email" placeholder="email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="foo" for="password" class="fieldinfo" style="color: rgb(251, 174, 44); font-size: 1.2em;">Password:</label>
                            <div class="input-group input-group-lg">
									<span class="input-group-addon">
										<span class="glyphicon glyphicon-lock text-primary"></span>
									</span>
                                <input class="form-control" type="password" name="password" id="password" placeholder="password">
                            </div>
                        </div>

                        <br>
                        <input class="btn btn-primary btn-sm" type="submit" name="submit" value="Login">
                    </fieldset>
                    <br>
                </form>


            </div><!--ending of main area -->
        </div><!--ending of row -->
    </div><!--ending of container -->


</body>
</html>