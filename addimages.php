<?php
ob_clean();
require_once 'header.php'; 



$sliderid = $_POST['sliderid'];
$image_thumb = $_POST['imagethumb'];
$image_medium = $_POST['image'];
$imagetitle = $_POST['imagetitle'];

$slidertitle = $_POST['slidertitle'];
$addimage = $_POST['addimage'];


$imageid = $_POST['imageid'];
$deleteimage = $_POST['deleteimage'];
$description = $_POST['description'];
$link = $_POST['link'];

if(isset($addimage) && $addimage === "addimage") {
	$action = addimage($sliderid,$image_thumb,$image_medium,$description,$imagetitle,$link);
	if($action == "success") {
		echo "<p>Image added to database</p>";
	}
}

if(isset($deleteimage) && $deleteimage === "deleteimage") {
	$action = deleteimage($imageid);
	if($action == "success") {
		echo "<p>Image deleted from database</p>";
	}
}


echo '<p style="text-align: center;">Add images for slider: <button class="btn btn-info btn-xs">'.$slidertitle.'</button></p>


<hr />
<form id="file_form" method="post" enctype="multipart/form-data" action="javascript:void(0);" autocomplete="on">
	<label for="browsed_file">Upload slider image: </label>
	<span class="btn btn-warning btn-file">
		<input type="file" name="browsed_file" id="browsed_file" href="javascript:void(0);" onchange="upload_fn();">
		<span class="glyphicon glyphicon-picture"> </span>  Browse
	</span>
</form>


<br />
<form action="" method="post">
	<input type="hidden" name="addimage" value="addimage"/>
	<input type="hidden" name="sliderid" value="'.$sliderid.'"/>
	<input type="hidden" name="slidertitle" value="'.$slidertitle.'" />

	<div id="upload_status"></div>

	<div class="form-group has-success">
		<label for="imagetitle" class="control-label">Image title: </label>
		<input type="text" class="form-control" id="imagetitle" placeholder="Image title" name="imagetitle" aria-describedby="helpblock">
	</div>

	<div class="form-group has-success">
		<label for="description" class="control-label">Image description: </label>
		<input type="text" class="form-control" id="description" placeholder="Image description" name="description" aria-describedby="helpblock">
	</div>


	<div class="form-group has-success">
		<label for="link" class="control-label">Image link: </label>
		<input type="text" class="form-control" id="link" placeholder="http://example.com/" name="link" aria-describedby="helpblock">
	</div>

	<br />
	<button type="submit" class="btn btn-default">Submit</button>
</form>

';



$dbquery = mysqli_query($con,"SELECT * FROM slider_images WHERE sliderid = '$sliderid'");

while($row = mysqli_fetch_array($dbquery)) {

	echo '<div class="col-md-3 imageslider">
	<form action="" method="post">
		<p style="text-align: right;">
			<button class="btn btn-danger btn-xs"><span class=" glyphicon glyphicon-trash"></span></button>
		</p>
		<input type="hidden" name="deleteimage" value="deleteimage" />
		<input type="hidden" name="imageid" value="'.$row['imageid'].'" />
		<input type="hidden" name="sliderid" value="'.$sliderid.'"/>
		<input type="hidden" name="slidertitle" value="'.$slidertitle.'" />
	</form>
	<img src="'.$row['image_medium'].'" class="img-responsive" />
</div>
';

}

echo '<div class="push"></div>';



require_once 'footer.php';

?>
