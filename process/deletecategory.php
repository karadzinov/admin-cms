<?php require_once '../config/conf.php'; ?>
<?php
$cat_id = $_GET['id'];



// Check connection
if (mysqli_connect_errno($con)) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


$delete = "DELETE FROM categories WHERE id = '$cat_id'";
$execute = mysqli_query($con, $delete);

header('Location: /addcategory.php');
?>
