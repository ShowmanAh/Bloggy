
<?php
require_once 'Classes/Query.php';
require_once 'partials/session.php';
require 'partials/direction.php';
confirmLogin ();
$post = new query();
if (isset($_GET['id'])){
    $comments_OnPost = $post->getComments ($_GET['id']);
}
$categories = $post->get_Categories ();
if (isset($_GET['id'])){
    $posts = $post->getPosts_ById ($_GET['id']);
}
// session email user
$author = $_SESSION['email'];
// ADD COMMENT ON POST
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(!(isset($_POST['comment']) && !empty($_POST['comment']))){
        $_SESSION['ErrorMessage'] = 'Comment should be filled';
    }else {
        $id = filter_input (INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $link = $post->connect ();
        $comment = mysqli_escape_string($link,$_POST['comment']);
        $post->add_comment ($comment, $author, $id);
        Redirect_to ('comments.php');

    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require 'partials/links.php'?>
    <title>full blog post</title>
    <style >


        .fieldinfo{
            color: rgb(251, 174, 44);
            font-size: 1.2em;
        }
        .col-sm-3{
            background-color: green;
        }
        img{
            box-shadow: 5px 5px 5px black;
        }
        .imageicon{
            margin-bottom: 15px;
            margin-top: 5px;

            max-width: 200px;
            max-height: 200px;

            display: block;
            box-shadow: 5px 5px 5px black;
        }

    </style>
</head>
<body>

<nav class="navbar navbar-inverse" role="navigation">
    <div class="container"><!--container -->

        <a class="navbar-header" >
            <div class="navbar-brand" href="blog.php">
                <img style="margin-top: -12px" src="image/kk.jpg" width=200; height=30;>
        </a>
    </div>


    <ul class="nav navbar-nav">
        <li class="active"><a href="blog.php" >Blog</a></li>
        <li><a href="categories.php" >Categories</a></li>
        <li><a href="admins.php" >Admins</a></li>
        <li><a href="comments.php"> Comments</a></li>
        
    </ul>


    </div>
</nav>
<div style="height: 10px; background: #27aaa1;"></div><!--make line -->
<div class="container"><!-- container -->
    <div class="blog-header">
        <h1>Complet the project CMS</h1>
        <p class="lead">the complet cms blog by me</p>
    </div>
    <div class="row"><!--start row-->
        <div class="col-sm-8"><!--main blog header-->
            <h4 style="color: aqua;">
                <?php echo Message();
                echo SuccessMessage();
                ?>
            </h4>
            <?php
            foreach ($posts as $post){

                ?>
                <div class="blogpost thumbnail">

                    <img class="img-responsive img-rounded" src="uploads/<?php echo $post['image']; ?>">
                    <div class="caption">
                        <h1 id="heading"><?php echo htmlentities($post['title']) ?></h1>
                        <p class="description">Category:<?php echo htmlentities($post['category']); ?> Published on <?php echo htmlentities($post['created_at']); ?></p>
                        <p class="post">
                            <?php echo nl2br($post['describtion']); ?></p><!--make paragraph-->

                    </div>

                </div>
            <?php } ?>
            <br><br>
            <br><br>

            <span class="fieldInfo" style="font-weight: bold; color: #2a6496">Comments</span>

            <?php
            //Extracting Comments
            foreach ($comments_OnPost as $raw_comment){

                ?>


                <div class="blockcomment" style="background-color: #f6f7f9;">
                    <img style="margin-left: 10px; margin-top: 10px;" src="image/comment.jpg" width="70" height="50" class="pull-left">
                    <p style="margin-left: 90px; margin-top: 20px;"><?php echo $raw_comment['created_at']; ?></p>
                    <p style="margin-left: 90px;"><?php echo $raw_comment['author']; ?></p>
                    <p style="margin-left: 90px;"><?php echo nl2br($raw_comment['comment']); ?></p>
                </div>
            <?php } ?>


            <br>

            <div>

                <form action="full_post.php?id=<?php echo $post['id']; ?>" method="post" enctype="multipart/form-data">
                    <fieldset>


                        <div class="form-group">
                            <label class="foo" for="Comment"><span style="color: #5e5e5e" class="fieldInfo">Add Your Comment:</span></label>
                            <textarea class="form-control" name="comment" id="comment"></textarea>
                        </div>


                        <br>
                        <input class="btn btn-primary btn-sm" type="submit" name="submit" value="submit">
                    </fieldset>
                    <br>
                </form>
            </div>
        </div>
        <div class="col-sm-offset-1 col-sm-3">
            <h2 style="color: blue;">About me</h2>
            <img class="img-responsive img-circle imageicon" src="image/3.jpg" style="margin-bottom: 30px; margin-top: 20px;">
            <p class="lead">Article or articles may refer to: Article (grammar), a grammatical element used to indicate definiteness or indefiniteness. Article (publishing), a piece of nonfictional prose that is an independent part of a publication.</p>

            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h2 class="panel-title">Categories</h2>
                </div>
                <div class="panel-body">
                    <?php
                    foreach ($categories as $category){


                        ?>
                        <a href="blog.php?Category=<?php echo $category['id']; ?>">
                            <span id="heading"><?php echo $category['name'] . "<br>";?></span>
                        </a>
                    <?php } ?>
                </div>
                <div class="panel-footer">

                </div>
            </div>


            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h2 class="panel-title">Recent Posts</h2>
                </div>
                <div class="panel-body">
                    <?php
                    foreach ($posts as  $post){

                        ?>
                        <div>
                            <img class="pull-left" style="margin-top: 10px; margin-left: 10px;" height="50px" width="50px" src="uploads/<?php echo htmlentities($post['image']); ?> ">
                          <?php
                          if($post['id']){ 
                          ?> 
                           <p style="margin-left: 80px;"><?php echo $post['title']; ?></p>
                          <?php } else{?>
                            <a href="full_post.php?id=<?php $post['id'] ?>">
                            <p style="margin-left: 80px;"><?php echo $post['title']; ?></p> 
                            </a>
                          <?php } ?> 
                           
                
                        

                            <p style="margin-left: 80px;"><?php echo $post['created_at']; ?></p>
                            <hr>
                        </div>
                    <?php } ?>

                </div>
                <div class="panel-footer">

                </div>
            </div>
        </div><!--side area ending-->
    </div><!--row ending-->
</div><!--container ending-->
<?php require 'partials/footer.php';?>
</body>
</html>