<?php 
require_once '../header.php';
require_once '../config/conf.php'; 

$category = $_POST['category'];
$pagetitle = $_POST['pagetitle'];
$subtitle = $_POST['subtitle'];
$pageurl = $_POST['pageurl'];
$pagetext = $_POST['pagetext'];
$discountamount  = $_POST['discountamount'];
$usedby = $_POST['usedby'];
$image = $_POST['image'];
$imagethumb = $_POST['imagethumb'];

if($category == NULL) {
	$status = "error";
}
else if($pagetitle == NULL) {
	$status = "error";
}
else if($subtitle == NULL) {
	$status = "error";
}
else if($pageurl == NULL) {
	$status = "error";
}
else if($pagetext == NULL) {
	$status = "error";
}
else if($discountamount == NULL) {
	$status = "error";
}
else if($image == NULL) {
	$status = "error";
}
else if($imagethumb == NULL) {
	$status = "error";
}
else {
	$status = "ok";
}

if ($status == "error") {
	echo '<p class="btn-danger">Please fill out all required fields <a href="../addcoupon.php">Back</a></p>';
}
else {
	$dbquery = mysqli_query($con, "INSERT INTO coupon (pagetitle, pagetext, subtitle, pageurl, discountamount, usedby, category, image, imagethumb)

		VALUES ('$pagetitle', '$pagetext', '$subtitle', '$pageurl', '$discountamount', '$usedby', '$category', '$image', '$imagethumb')");
	ob_start();
	header('Location: ../admin.php');
}

require_once '../footer.php';

?>
