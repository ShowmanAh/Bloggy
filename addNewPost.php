<?php
require 'Classes/Post.php';
require 'partials/session.php';
require 'partials/direction.php';
confirmLogin ();
$post = new Post();
$categories = $post->getCategories ();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(!(isset($_POST['title']) && !empty($_POST['title']))){
        $_SESSION['ErrorMessage'] = 'Title should be filled';
    }elseif(!(isset($_POST['category']) && !empty($_POST['category']))){
        $_SESSION['ErrorMessage'] = 'category should be filled';
    }elseif (!(isset($_POST['description']) && !empty($_POST['description']))){
        $_SESSION['ErrorMessage'] = 'Description should be filled';
    }else {
        // open connection 
        $link = $post->connect ();
        $title = mysqli_escape_string($link,$_POST['title']);
        $category = mysqli_escape_string($link, $_POST['category']);
        $description = mysqli_escape_string($link, $_POST['description']);
        $admin = $_SESSION['email'];
        //$upload_dir = $_SERVER['DOCUMENT_ROOT'] .'/uploads';
        $avatar = '';
        $allowed_image_extension = ["png",
            "jpg",
            "jpeg"];
        $file_extension = pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION);
        if(!in_array ($file_extension,$allowed_image_extension)){
            $_SESSION['ErrorMessage'] = "Upload valid images. Only PNG and JPEG are allowed.";
            Redirect_to ('addNewPost.php');
            //exit();
        }
        elseif($_FILES['avatar']['error'] == UPLOAD_ERR_OK){
            $avatar = $_FILES['avatar']['name'];
            $upload_dir="uploads/".basename($avatar);
            $tmp_name = $_FILES['avatar']['tmp_name'];
            //$avatar = $_FILES['avatar']['name'];
            move_uploaded_file ($tmp_name, $upload_dir);
        }else{
            echo 'file can not be uploaded';
        }
        $post->addPost ($title, $category, $admin, $avatar, $description);
        Redirect_to ('Dashboard.php');



    }

}

?>
    <!DOCTYPE html>
    <html lang="en">
<head>
    <?php require 'partials/links.php'?>
    <title>Add New Post</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <?php require 'partials/sidebar.php'?>
        <div class="col-sm-10">
            <h1>Add New Post</h1>
            <?php echo Message();
            echo SuccessMessage();
            ?>
            <div>
                <form method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">
                            <label class="foo" for="title"><span class="fieldInfo">Title :</span></label>
                            <input class="form-control" type="text" name="title" id="title" placeholder="TiTle">

                        </div>
                        <div class="form-group">
                            <label class="foo" for="category"><span class="fieldInfo">Category :</span></label>
                            <select class="form-control" id="category" name="category">
                                <?php
                                    foreach ($categories as $category){
                                ?>
                                    <option><?php echo $category['name']; ?></option>
                                <?php } ?>

                            </select>
                        </div>
                        <div class="form-group">
                            <label class="foo" for="avatar"><span class="fieldInfo">Select Image :</span></label>
                            <input type="file" class="form-control" name="avatar" id="avatar">
                        </div>
                        <div class="form-group">
                            <label class="foo" for="description"><span class="fieldInfo">Description:</span></label>
                            <textarea class="form-control" name="description" id="description"></textarea>
                        </div>


                        <br>
                        <input class="btn btn-success btn-sm" type="submit" name="submit" value="Add New Post">
                    </fieldset>
                    <br>
                </form>
            </div>




        </div><!--ending of main area -->
    </div><!--ending of row -->
</div><!--ending of container -->
<?php require 'partials/footer.php';?>
</body>
    </html><?php
