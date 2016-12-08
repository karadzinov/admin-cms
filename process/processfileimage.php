<?php require_once '../config/conf.php'; ?>
<?php
$file = $_POST['slika'];
$file_title = $_POST['name'];


if ($image == NULL) {
    echo "error"; 
} else {

    $sql = "INSERT INTO files (file, file_title) VALUES ('$file', '$file_title')";
    if (!mysqli_query($con, $sql)) {
        die('Error: ' . mysqli_error($con));
    }
    ob_start();
    header('Location: /addfile.php');

    mysqli_close($con);
}
?>
</body>
</html>