
<?php
//require 'Classes/Post.php';
require 'Classes/Comment.php';
require 'partials/session.php';
confirmLogin ();
//$post = new Post();
//$posts = $post->getPosts ();
$comment = new Comment();
$posts = $comment->getPosts ();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/adminstyle.css">
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <title>DASHBORDER</title>
    <style>
        body{
            margin: 0;
            padding: 0;


        }
        #footer{
            margin-bottom: 2px;
        }
    </style>
</head>
<body>
<!--<div style="height: 10px; background: #27aaa1; margin-top: 0px;"></div> -->
<nav class="navbar navbar-inverse" role="navigation" style="margin-top: 0px;">
    <div class="container"><!--container -->

        <a class="navbar-header" >
            <div class="navbar-brand" href="blog.php" style="margin-left: 0px;">
                <img style="margin-top: -12px" src="image/kk.jpg" width=100; height=30; style="margin-left: 0px;">
        </a>
    </div>


    <ul class="nav navbar-nav">
        <li class="active"><a href="blog.php" >Blog</a></li>
        <li><a href="categories.php" >Categories</a></li>
        <li><a href="admins.php" >Admins</a></li>
        <li><a href="comments.php" > Comments</a></li>

    </ul>




    </div>
</nav>
<div style="height: 10px; background: #27aaa1;"></div>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-2">
            <br><br>
            <ul id="side_menue" class="nav nav-pills nav-stacked">
                <li class="active"><a href="Dashboard.php">
                        <span class="glyphicon glyphicon-th"></span> &nbsp;Dashborder</a>
                </li>
                <li><a href="addNewPost.php"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Add new post</a></li>
                <li><a href="categories.php"><span class="glyphicon glyphicon-tags"></span>&nbsp;Categories</a></li>
                <li><a href="admins.php"><span class="glyphicon glyphicon-user">
					</span>&nbsp;Manage Admins</a></li>
                <li><a href="comments.php"><span class="glyphicon glyphicon-comment">
					</span>&nbsp;Comments


                        <?php
                        //Total Comments
                       $countComment = $comment->countOffComments ();
                        $Total=array_shift($countComment);//Returns the value of the removed element from an array, or NULL if the array is empty
                        if ($Total>0) {

                            ?>
                            <span class="label pull-right label-warning" style="margin-right: 5px; ">
										<?php echo $Total; ?>
									</span>
                        <?php } ?>



                    </a>
                </li>
                <li><a href="blog.php?page=1" target="_blank"><span class="glyphicon glyphicon-tags"></span>&nbsp;live Blogs</a></li>
                <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;logout</a></li>
            </ul>
        </div><!--ending of side area -->
        <div class="col-sm-10">
            <div><?php echo Message();
                echo SuccessMessage();
                ?></div>
            <h1>Admin dashboard</h1>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <tr>
                        <th>NO</th>
                        <th>Post Title</th>
                        <th>Date Time</th>
                        <th>Author</th>
                        <th>Category</th>
                        <th>Banner</th>
                        <th>Comment</th>
                        <th>Actions</th>
                        <th>Details</th>
                    </tr>
                    <?php
                    foreach ($posts as $post){
                    ?>
                    <tr>
                        <td><?php echo $post['id']; ?></td><!--instade of id start 1 and increment-->
                        <td style="color: blue;">
                            <?php
                            if (strlen ($post['title'] > 20)) {
                                $post['title'] = substr ($post['title'], 0, 20) . '....';
                            }
                            echo $post['title']; ?>

                        </td>
                        <td>
                            <?php
                            if (strlen ($post['created_at'] > 11)) {
                                $post['created_at'] = substr ($post['created_at'], 0, 11) . '...';
                            }
                            echo $post['created_at']; ?>

                        </td>
                        <td>
                            <?php
                            if (strlen ($post['author'] > 6)) {
                                $post['author'] = substr ($post['author'], 0, 6) . '...';
                            }
                            echo $post['author']; ?>

                        </td>
                        <td><?php echo $post['category']; ?></td>
                        <td><?php if($post['image']) { ?><img src="uploads/<?= $post['image']?>" style="width: 50px; height: 50px; "/>
                            <?php } else { ?> <img src="uploads/none.jpg" style="width: 50px; height: 50px; "/>
                            <?php } ?>
                        </td>

                        <td>

                            <?php
                            //nummbers of Approve comments
                            $approvedComment = $comment->count_Comments_ON_post ($post['id']);
                            $Total_Approved = array_shift ($approvedComment);//Returns the value of the removed element from an array, or NULL if the array is empty
                            if ($Total_Approved > 0) {

                            ?>
                            <span class="label pull-right label-success">
										<?php echo $Total_Approved; ?>
									</span>
                            <?php } ?>

                              <?php  ?>
                                <?php
                                //nummbers of UNApprove comments

                                $dis_approve = $comment->count_Comments_OFF_post ($post['id']);

                                $Total_UnApproved=array_shift($dis_approve);//Returns the value of the removed element from an array, or NULL if the array is empty
                                 if ($Total_UnApproved>0) {

                                    ?>
                                    <span class="label pull-right label-danger" style="margin-right: 5px; ">
										<?php echo $Total_UnApproved; ?>
									</span>
                                <?php } ?>

                            </td>
                        <td>
                            <a href="edit_post.php?id=<?php echo $post['id']; ?>">
                                <span class="btn btn-warning">Edit Post</span>
                            </a>
                            <a href="delete_post.php?id=<?php echo $post['id']; ?>">
                                <span class="btn btn-danger" style="margin-top: 10px;">Delete Post</span>
                            </a>
                        </td>
                            <td>
                                <a href="full_post.php?id=<?php echo $post['id']; ?>" target="_blank">
                                    <span class="btn btn-primary">Live preview</span>
                                </a>
                            </td>
                        </tr>


                    <?php } ?>

                </table>

            </div>

        </div><!--ending of main area -->
    </div><!--ending of row -->
</div><!--ending of container -->
<?php
require 'partials/footer.php';
?>
</body>
</html>