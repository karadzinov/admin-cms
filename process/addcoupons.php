<?php 
require_once '../header.php';
require_once '../config/conf.php'; 

$coupontitle = $_POST['coupontitle'];
$couponcode = $_POST['couponcode'];
$discountamount = $_POST['discountamount'];
$affiliatelink = $_POST['affiliatelink'];
$coupon_id = $_POST['coupon_id'];
$used_by = $_POST['used_by'];


if($coupontitle == NULL) {
	$status = "error";
}
else if($couponcode == NULL) {
	$status = "error";
}
else if($discountamount == NULL) {
	$status = "error";
}
else if($affiliatelink == NULL) {
	$status = "error";
}
else if($coupon_id == NULL) {
	$status = "error";
}
else if($discountamount == NULL) {
	$status = "error";
}
else if($used_by == NULL) {
	$status = "error";
}

else {
	$status = "ok";
}

if ($status == "error") {
	echo '<p class="btn-danger">Please fill out all required fields <a href="../addcoupon.php">Back</a></p>';
}
else {
	$dbquery = mysqli_query($con, "INSERT INTO coupons (coupontitle, couponcode, discountamount, affiliatelink, coupon_id, used_by)

		VALUES ('$coupontitle', '$couponcode', '$discountamount', '$affiliatelink', '$coupon_id', '$used_by')");
	ob_start();
	header('Location: ../listcoupons.php');
}

require_once '../footer.php';

?>
