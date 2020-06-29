<?php
require 'Classes/Admins.php';
require 'partials/session.php';
require 'partials/direction.php';
// check authenicated user
confirmLogin ();
$user = new Admins();


if($_SERVER['REQUEST_METHOD'] == 'POST'){// check request 
    // validation for inputs
    if(!(isset($_POST['name']) && !empty($_POST['name']))){
       $_SESSION['ErrorMessage'] = 'Name should be filled';
    }elseif (!(isset($_POST['email']) && filter_input(INPUT_POST,'email', FILTER_VALIDATE_EMAIL))){
        $_SESSION['ErrorMessage'] = 'Email should be filled/invalid email';
    }elseif (!(isset($_POST['password']) && $_POST['password'] > 5)){
        $_SESSION['ErrorMessage'] = 'password should be filled/ at least 6 character';
    }else {
        $link = $user->connect ();
        $name = mysqli_escape_string($link,$_POST['name']);
        $email = mysqli_escape_string($link, $_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $admin = (isset($_POST['admin'])) ? 1 : 1;
        if($email !=""){
            $num_rows = $user->getEmail ($email);

            if($num_rows >= 1){
                $_SESSION['ErrorMessage'] = 'Email is Token before';
                Redirect_to ('addUser.php');
                exit();
            }else{

                //$upload_dir = $_SERVER['DOCUMENT_ROOT'] .'/uploads';
                $avatar = '';
                $allowed_image_extension = ["png",
                    "jpg",
                    "jpeg"];
                $file_extension = pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION);
                if(!in_array ($file_extension,$allowed_image_extension)){
                    $_SESSION['ErrorMessage'] = "Upload valid images. Only PNG and JPEG are allowed.";
                    Redirect_to ('addUser.php');
                    //exit();
                }
                elseif($_FILES['avatar']['error'] == UPLOAD_ERR_OK){
                    //$image=$_FILES["avatar"]["name"];
                    $avatar = $_FILES['avatar']['name'];
                    $upload_dir="uploads/".basename($avatar);
                    $tmp_name = $_FILES['avatar']['tmp_name'];
                    //$avatar = $_FILES['avatar']['name'];
                    move_uploaded_file ($tmp_name, $upload_dir);
                }else{
                    echo 'file can not be uploaded';
                }
                $user->addUser ($name,$email,$avatar,$password,$admin);
                Redirect_to ('admins.php');




            }
        }else{
            $_SESSION['ErrorMessage'] = 'Email should be filled';
        }

    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    require 'partials/links.php';
    ?>
    <title>Add User</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <?php
        require 'partials/sidebar.php';
        ?>

        <div class="col-sm-10">
            <h1>Add new  User </h1>
            <?php echo Message (); ?>
            <?php echo SuccessMessage (); ?>

            <div>
                <form method="post" enctype="multipart/form-data">
                   <fieldset>
                       <div class="form-group">
                           <label for="name">Name:</label>
                           <input class="form-control" type="text" name="name" id="name" placeholder="your name" value="<?= (isset($_POST['name'])) ? $_POST['name'] : '' ?>"/>

                       </div>
                       <div class="form-group">
                           <label for="email">Email:</label>
                           <input  class="form-control" type="email" name="email" id="email" placeholder="your email" value="<?= (isset($_POST['email'])) ? $_POST['email'] : ''?>"/>

                       </div>
                       <div class="form-group">
                           <label for="email">Image:</label>
                           <input type="file" name="avatar" id="avatar" placeholder="your image">

                       </div>
                       <div class="form-group">
                           <label for="password">Password:</label>
                           <input class="form-control" type="password" name="password" id="password" placeholder="your password" value="<?= (isset($_POST['password'])) ? $_POST['password'] : ''?>"/>

                       </div>
                       <div class="form-group">
                           <label for="admin">Admin</label>
                           <input type="checkbox" name="admin" <?= (isset($_POST['admin'])) ? 'checked' : '' ?> />

                       </div>
                         <br>
                       <input class="btn btn-primary" type="submit" name="submit" value="Add User">
                   </fieldset>
                    <br>
                </form>
            </div>

        </div>
    </div>
</div>
</body>
<?php
require 'partials/footer.php';
?>
</html>