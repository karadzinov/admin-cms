<?php
require_once 'header.php';

$id = $_GET['id'];

$usedby = rand(500, 2000);
?>
<div class="row">
	<div class="col-md-10">

		<form role="form" action="process/addcoupons.php" method="post">
			<div class="form-group">
				<label for="coupontitle">Coupon Title</label>
				<input type="text" class="form-control" id="coupontitle" name="coupontitle" placeholder="Enter title">
			</div>	
			<div class="form-group">
				<label for="couponcode">Coupon Code</label>
				<input type="text" class="form-control" id="couponcode" name="couponcode" placeholder="Enter Code">
			</div>	
			<div class="form-group">
				<label for="discountamount">Discount Amount</label>
				<input type="text" class="form-control" id="discountamount" name="discountamount" placeholder="Enter Amount">
			</div>	
			<div class="form-group">
				<label for="affiliatelink">Affiliate Link</label>
				<input type="text" class="form-control" id="affiliatelink" name="affiliatelink" placeholder="Enter Link">
			</div>	
			<div class="form-group">
				<input type="hidden" name="coupon_id" value="<?php echo $id; ?>">
				<input type="hidden" name="used_by" value="<?php echo $usedby; ?>">
				<button type="submit" class="btn btn-info">Submit</button>
			</div>	
		</form>
	</div>
</div>
<?php
require_once 'footer.php';
?>