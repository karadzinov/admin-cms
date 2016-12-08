<?php
require_once '../config/conf.php'; ?>

<?php
$title = $_POST['title'];
$parent_id = $_POST['parent_id'];

if ($title == NULL) {
    echo "error";
} 
else {
    
    $sql = "INSERT INTO categories (title,parent_id) VALUES ('$title','$parent_id')";
    if (!mysqli_query($con, $sql)) {
        die('Error: ' . mysqli_error($con));
    }
    
    ob_start();
    header('Location: /addcategory.php');
}
?>
