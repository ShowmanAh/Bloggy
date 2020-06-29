<?php
require 'Classes/Admins.php';
require 'partials/session.php';
confirmLogin ();
$user = new Admins();
$users = $user->getUsers ();
// search keyword search
if(isset($_GET['search'])){
    $users = $user->searchUsers ($_GET['search']);
}
/**
if(is_array ($users)){
    var_dump ($users);
    return 0;
}else{
    echo 'not associative ';
    return 1;
}
*/
?>

    <!DOCTYPE html>
    <html lang="en">
<head>
   <?php
   require 'partials/links.php';
   ?>
    <title>Manage Admins</title>
    <style>
        img{

            box-shadow: 5px 5px 5px black;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
       <?php
       require 'partials/sidebar.php';
       ?>

        <div class="col-sm-10">
            <h1>Manage Admins Access</h1>
            <form class="navbar-form" style="margin-left: 500px;" method="get">
                <div class="form-group">
                    <input class="form-control" type="text" name="search" placeholder="search">
                </div>
                <input class="btn btn-success" type="submit" value="search">
            </form>
         <a href="addUser.php">
             <span class="btn btn-primary" style="margin-bottom: 10px;">Add New User</span>
         </a>
            <span><?php echo count ($users); ?> Users</span>

            <div class="table-responsive">
                <table class="table table-striped table-hover ">
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Date/time</th>
                        <th>Action</th>
                    </tr>
                    <?php

                    foreach ($users as $row){

                        ?>
                        <tr>
                            <td><?php if($row['avatar']) { ?><img src="uploads/<?= $row['avatar']?>" style="width: 50px; height: 50px; "/>
                                <?php } else { ?> <img src="uploads/none.jpg" style="width: 50px; height: 50px; "/>
                                <?php } ?>
                            </td>

                            <td><?= $row['name'] ?> </td>
                            <td><?= $row['email'] ?> </td>
                            <td><?= $row['created_at'] ?></td>
                            <td><a href="deleteUser.php?id=<?= $row['id'] ?>">
                                    <span class="btn btn-danger">Delete</span>
                                </a></td>

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
