<?php
require 'Classes/Category.php';
require 'partials/session.php';
require 'partials/direction.php';
//check authenication
confirmLogin ();
$cat = new Category();
$creator = $_SESSION['email'];
$id = filter_input (INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$row = $cat->getCategoryById ($id);
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(!(isset($_POST['name']) && !empty($_POST['name']))){
        $_SESSION['ErrorMessage'] = 'Name should be filled';
    }else {
        // open connection
        $link = $cat->connect ();
        $id = filter_input(INPUT_POST,'id',FILTER_SANITIZE_NUMBER_INT);
        $name = mysqli_escape_string($link,$_POST['name']);
        $cat->updateCategory ($name, $creator, $id) ;
        Redirect_to ('categories.php');

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
            <h1>Edit Category </h1>
            <?php echo Message (); ?>
            <?php echo SuccessMessage (); ?>

            <div>
                <form method="post">
                    <fieldset>
                        <div class="form-group">
                            <label class="foo" for="categoryName">Name:</label>
                            <input class="form-control" type="text" name="name" id="name" placeholder="enter your category name" value="<?=(isset($row['name']) ? $row['name'] : '') ?>">
                            <input type="hidden" name="id" id="id" value="<?= (isset($row['id'])) ? $row['id'] : '' ?>">
                        </div>
                        <br>
                        <input class="btn btn-success btn-sm" type="submit" name="submit" value="Edit category">
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