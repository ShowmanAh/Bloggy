<?php
require 'Classes/Category.php';
require 'partials/session.php';
confirmLogin ();
$cat = new Category();
$categories = $cat->getCategories ();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    require 'partials/links.php';
    ?>
    <title >Manage Categores</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <?php
        require 'partials/sidebar.php';
        ?>
        <div class="col-sm-10">
            <h1 style="margin-bottom: 20px; margin-top: 30px; text-align: center;">Manage categories</h1>
            <a href="addCategory.php">
                <span class="btn btn-primary" style="margin-bottom: 20px;" >Add Category</span>
            </a>
            <span><?php echo count ($categories); ?> Categories</span>

            <?php echo Message();
            echo SuccessMessage();
            ?>

            <div class="table-responsive">
                <table class="table table-striped table-hover ">
                    <tr>
                        <th>SrNo</th>
                        <th>Category Name</th>
                        <th>Creater Name</th>
                        <th>Date,time</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    foreach ($categories as $category) {


                    ?>
                  <tr>
                      <td><?= $category['id']?></td>
                      <td><?= $category['name']?></td>
                      <td><?= $category['creater']?></td>
                      <td><?= $category['created_at']?></td>
                      <td><a href="editCategory.php?id=<?= $category['id'] ?>">
                              <span class="btn btn-success">Edit </span>
                          </a> ||
                          <a href="deleteCategory.php?id=<?= $category['id'] ?>">
                              <span class="btn btn-danger">Delete </span>
                          </a>
                      </td>


                  </tr>
                        <?php
                    }
                    ?>
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