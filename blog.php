<?php
require 'partials/session.php';
require 'Classes/Query.php';
confirmLogin ();
$query = new Query();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/publicstyle.css">
    <title>blog</title>
    <style >

        .imageicon{
            margin-bottom: 15px;
            margin-top: 5px;

            max-width: 200px;
            max-height: 200px;

            display: block;
            box-shadow: 5px 5px 5px black;
        }
        img{
            box-shadow: 5px 5px 5px black;
        }


    </style>
</head>
<body>
<div style="height: 10px; background: #27aaa1;"></div>
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
        <li><a href="comments" > Comments</a></li>


    </ul>


    <form class="navbar-form" style="margin-left: 500px;" method="get">
        <div class="form-group">
            <input class="form-control" type="text" name="search" placeholder="search">
        </div>
        <input class="btn btn-success" type="submit" value="search">
    </form>


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
            <?php
            if (isset($_GET["search"])) {
                $viewQuery = $query->searchPost ($_GET['search']);
                //query when category is active URL tab
            }elseif (isset($_GET["category"])) {

                $viewQuery = $query->getPostsByCategory ($_GET['category']);
            }
            //query when pagination is active... blog.php?page=1
            elseif (isset($_GET["page"])) {
                $page=$_GET["page"];
                if ($page==0||$page<1) {
                    $page_post=0;
                }else{
                    $page_post=($page*5)-5;

                }
                $viewQuery = $query->getPostByPage ($page_post);

            }

            else {
                $viewQuery = $query->getPost ();
            }
            //select data
            foreach ($viewQuery as $view){



                ?>
                <div class="blogpost thumbnail">

                    <img class="img-responsive img-rounded" src="uploads/<?php echo $view['image']; ?>">
                    <div class="caption">
                        <h1 id="heading"><?php echo htmlentities($view['title']) ?></h1>
                        <p class="description">Category:<?php echo htmlentities($view['category']); ?> Published on <?php echo htmlentities($view['created_at']); ?>




                            <?php
                            //nummbers of Approve comments
                            $queryApproved = $query->count_Comments_ON_post ($view['id']);


                            $TotalApproved = array_shift($queryApproved);//Returns the value of the removed element from an array, or NULL if the array is empty
                            if ($TotalApproved>0) {

                                ?>
                                <span class="label pull-right label-success">
                                       Comments: <?php echo $TotalApproved; ?>
                                    </span>
                            <?php } ?>


                        </p>
                        <p class="post"><?php
                            if (strlen($view['describtion'])>150) {
                                $view['describtion']=substr($view['describtion'], 0, 150) . '....';
                            }
                            echo htmlentities($view['describtion']); ?></p>

                    </div>
                    <a href="full_post.php?id=<?php echo $view['id']; ?>"><span class="btn btn-info" style="float: right;">Read More </span></a>
                </div>
            <?php } ?>
            <nav>
                <ul class="pagination pull-center pagination-lg" style="margin-top: 5px; margin-bottom: 15px; margin-right: 20px;">
                    <?php
                    //Creating backward button
                    if (isset($page)) {
                        if ($page>1) {
                            # code...


                            ?>
                            <li><a href="blog.php?page=<?php echo $page-1; ?>">&laquo</a></li>
                        <?php }
                    }?>
                    <?php
                    //make pagination
                    $rowPage = $query->count_Posts ();
                    $total_post=array_shift($rowPage);
                    $post_pagination=$total_post/5;
                    $post_pagination=ceil($post_pagination);
                    for ($i=1; $i <= $post_pagination ; $i++) {
                        if (isset($page)) {
                            if ($i==$page) {



                                ?>
                                <li class="active"><a href="blog.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                <?php
                            }else{ ?>
                                <li><a href="blog.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                <?php
                            }

                        }
                    }?>
                    <?php
                    //Creating forward button
                    if (isset($page)) {
                        if ($page+1<=$post_pagination) {



                            ?>
                            <li><a href="blog.php?page=<?php echo $page+1; ?>">&raquo</a></li>
                        <?php }
                    }?>

                </ul>
            </nav>


        </div><!--main area ending-->
        <div class="col-sm-offset-1 col-sm-3">
            <h2 style="color: blue;">About me</h2>
            <img class="img-responsive img-circle imageicon" src="image/3.jpg">
            <p class="lead">Article or articles may refer to: Article (grammar), a grammatical element used to indicate definiteness or indefiniteness. Article (publishing), a piece of nonfictional prose that is an independent part of a publication.</p>

            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h2 class="panel-title">Categores</h2>
                </div>
                <div class="panel-body">
                    <?php
                    //category
                    $rows = $query->getCategories ();
                    foreach ($rows as $dataRaw){


                        ?>
                        <a href="blog.php?Category=<?php echo $dataRaw['name']; ?>">
                            <span id="heading"><?php echo $dataRaw['name'] . "<br>";?></span>
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
                    //get recent post data
                    $posts = $query->getPostLimit5 ();
                    foreach ($posts as $post){

                        ?>
                        <div>
                            <p><?php if($post['image']) { ?><img src="uploads/<?= $post['image']?>" style="width: 50px; height: 50px; "/>
                                <?php } else { ?> <img src="uploads/none.jpg" style="width: 50px; height: 50px; "/>
                                <?php } ?>
                            </p>

                            <a href="full_post.php?id=<?php echo $post['id']; ?>">
                                <p style="margin-left: 80px;"><?php echo $post['title']; ?></p>
                            </a>

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
<?php
require 'partials/footer.php';
?>
</body>
</html>