<?php require_once 'header.php'; ?>

<table class="table">
<tr>
<th>Page Title</th>
<th>Coupon Title</th>
</tr>
<?php
$dbquery = mysqli_query($con, "SELECT * FROM coupons INNER JOIN coupon ON coupons.coupon_id = coupon.id");
while ($row = mysqli_fetch_array($dbquery)) {
	echo "<tr>";
	echo '<td>'.$row['pagetitle'].'</td>';
	echo '<td>'.$row['coupontitle'].'</td>';
	echo "</tr>";
}

?>
</table>

<?php require_once 'footer.php'; ?>