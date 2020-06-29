<?php
require 'Classes/Comment.php';
require 'partials/session.php';
confirmLogin ();
$comment = new Comment();
$unApproveComments = $comment->getUNApprovedComment ();
$approveComments = $comment->getApprovedComment ();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    require 'partials/links.php';
    ?>

    <title>Comments</title>
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
        <li><a href="blog.php" >Blog</a></li>
        <li><a href="categories.php" >Categories</a></li>
        <li><a href="admins.php" >Admins</a></li>
        <li class="active"><a href="comments.php" > Comments</a></li>

    </ul>



    </div>
</nav>
<div style="height: 10px; background: #27aaa1;"></div>

<div class="container-fluid">
    <div class="row">
        <?php
        require 'partials/sidebar.php';
        ?>
        <div class="col-sm-10">
            <div><?php echo Message();
                echo SuccessMessage();
                ?></div>
            <h1> UN Approve Comment</h1>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <tr>
                        <th>NO.</th>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Comment</th>
                        <th>Approve</th>
                        <th>Delete</th>
                        <th>Details</th>
                    </tr>
                    <?php

                    foreach ($unApproveComments as $unApprove){

                        ?>
                        <tr>
                            <td><?php echo htmlentities(count($unApproveComments)); ?></td>
                            <td style="color: blue;"><?php echo htmlentities($unApprove['author']); ?></td>
                            <td><?php echo htmlentities($unApprove['created_at']); ?></td>
                            <td><?php echo htmlentities(strlen ($unApprove['comment']) > 10 ? substr ($unApprove['comment'], 0, 10).'': $unApprove['comment']); ?></td>

                            <td><a href="approveComment.php?id=<?php echo $unApprove['id']; ?>"><span class="btn btn-success">Aprrove</span></a></td>
                            <td><a href="deleteComment.php?id=<?php echo  $unApprove['id']; ?>"><span class="btn btn-danger">Delete</span></a></td>
                            <td><a href="full_post.php?id=<?php echo  $unApprove['post_id']; ?>"><span class="btn btn-primary">live preview</span></a></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>


            <h1> Approved Comment</h1>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <tr>
                        <th>NO.</th>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Comment</th>
                        <th> Revert Approve</th>
                        <th>Delete</th>
                        <th>Details</th>
                    </tr>
                    <?php

                        foreach ($approveComments as $approve){

                        ?>
                        <tr>
                            <td><?php echo htmlentities(count($approve)); ?></td>
                            <td><?php echo htmlentities($approve['author']); ?></td>

                            <td><?php echo htmlentities($approve['created_at']); ?></td>
                            <td><?php echo htmlentities(strlen ($approve['comment']) > 10 ? substr ($approve['comment'], 0, 10).'': $approve['comment']); ?></td>


                            <td><a href="disApproveComment.php?id=<?php echo $approve['id']; ?>"><span class="btn btn-warning"> DisAprrove</span></a></td>
                            <td><a href="deleteComment.php?id=<?php echo $approve['id']; ?>"><span class="btn btn-danger">Delete</span></a></td>
                            <td><a href="full_post.php?id=<?php echo  $approve['post_id']; ?>"><span class="btn btn-primary">live preview</span></a></td>
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