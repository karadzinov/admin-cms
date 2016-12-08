
<?php require_once '../config/conf.php'; ?>

<?php
$name = $_POST['name'];
$blogcontent = $_POST['blogcontent'];
$image = $_POST['image'];
$imagethumb = $_POST['imagethumb'];
$embed = $_POST['embed'];
$username = $_POST['username'];



if ($blogcontent == NULL) {
    echo "error";
} else {

    $sql = "INSERT INTO blog (name, blogcontent, image, imagethumb, embed, username) VALUES ('$name', '$blogcontent', '$image', '$imagethumb', '$embed','$username')";
    if (!mysqli_query($con, $sql)) {
        die('Error: ' . mysqli_error($con));
    }
    ob_start();
    header('Location: ../index.php');

    mysqli_close($con);
}
?>
</body>
</html>