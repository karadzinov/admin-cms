<?php
require_once "header.php";

$general = $_POST['general'];

if(isset($general) && $general === "general") {
  $title = $_POST['title'];
  $mainurl = $_POST['url'];
  $email = $_POST['email'];
  $description = $_POST['description'];
  $id = $_POST['mainid'];
  $image = $_POST['image'];
  $image_thumb = $_POST['imagethumb'];
  $address = $_POST['address'];
  $phone = $_POST['phone'];
  $twitter = $_POST['twitter'];
  $facebook = $_POST['facebook'];
  $skype = $_POST['skype'];
  $linkedin = $_POST['linkedin'];
  $gplus = $_POST['gplus'];
  $youtube = $_POST['youtube'];
  $flickr = $_POST['flickr'];
  $pinterest = $_POST['pinterest'];
  $action = updategeneral($title,$mainurl,$email,$description,$image,$image_thumb,$address,$phone,$twitter,$facebook,$skype,$linkedin,$gplus,$youtube,$flickr,$pinterest,$id);
}
$dbquery = mysqli_query($con, "SELECT * FROM general ORDER BY id DESC LIMIT 1");
$row = mysqli_fetch_array($dbquery);

echo '<h4>General Settings</h4>

<form id="file_form" method="post" enctype="multipart/form-data" action="javascript:void(0);" autocomplete="on">
  <label for="browsed_file">Upload website logo: </label>
  <span class="btn btn-warning btn-file">
    <input type="file" name="browsed_file" id="browsed_file" href="javascript:void(0);" onchange="upload_fn();">
    <span class="glyphicon glyphicon-picture"> </span>  Browse
  </span>
</form>

<form action="" method="post" id="stylebrand" >
  <input type="hidden" name="general" value="general" />
  <input type="hidden" name="mainid" value="'.$row['id'].'" />
  <br />
  ';

  if(isset($row['image_thumb'])) {
   $image = '<img src="'.$row['image_thumb'].'" alt="'.$row['title'].'"/>';
 }
 echo '
 <div id="upload_status">' . $image . '</div>
 <br />

 <div class="form-group">
   <label for="title">Title: </label>
   <input type="text" class="form-control" id="title" placeholder="Website Title. No longer than 60-70 characters." name="title" value="' . $row['title'] . '">
 </div>

 <div class="form-group">
   <label for="title">URL: </label>
   <input type="text" class="form-control" id="url" placeholder="http://example.com" name="url" value="' . $row['mainurl'] . '">
 </div>

 <div class="form-group">
   <label for="email">Email address: </label>
   <input type="email" class="form-control" id="email" placeholder="Contact email address" name="email" value="' . $row['email'] . '">
 </div>

 <div class="form-group">
   <label for="phone">Phone number: </label>
   <input type="phone" class="form-control" id="phone" placeholder="+1234567890" name="phone" value="' . $row['phone'] . '">
 </div>

 <div class="form-group">
 <label for="address">Address: </label>
   <input type="address" class="form-control" id="address" placeholder="One infinity loop, 54100" name="address" value="' . $row['address'] . '">
 </div>

 <div class="form-group">
   <label for="description">Website description: </label>
   <input type="text" class="form-control" id="description" placeholder="Page description. No longer than 155 characters." name="description" value="' . $row['description'] . '">
 </div>


 <div class="form-group">
   <label for="twitter">Twitter account: </label>
   <input type="text" class="form-control" id="twitter" placeholder="@example" name="twitter" value="' . $row['twitter'] . '">
 </div>

 <div class="form-group">
   <label for="facebook">Facebook account: </label>
   <input type="text" class="form-control" id="facebook" placeholder="http://facebook.com/example" name="facebook" value="' . $row['facebook'] . '">
 </div>

 <div class="form-group">
   <label for="skype">Skype account: </label>
   <input type="text" class="form-control" id="skype" placeholder="skypeusername" name="skype" value="' . $row['skype'] . '">
 </div>

 <div class="form-group">
   <label for="linkedin">Linked In account: </label>
   <input type="text" class="form-control" id="linkedin" placeholder="http://linkedin/" name="linkedin" value="' . $row['linkedin'] . '">
 </div>

 <div class="form-group">
   <label for="gplus">Google Plus account: </label>
   <input type="text" class="form-control" id="gplus" placeholder="http://plus.google.com/+username" name="gplus" value="' . $row['gplus'] . '">
 </div>

 <div class="form-group">
   <label for="youtube">Youtube account: </label>
   <input type="text" class="form-control" id="youtube" placeholder="http://youtube.com/account" name="youtube" value="' . $row['youtube'] . '">
 </div>

 <div class="form-group">
   <label for="flickr">Flickr account: </label>
   <input type="text" class="form-control" id="flickr" placeholder="http://flickr/account" name="flickr" value="' . $row['flickr'] . '">
 </div>

 <div class="form-group">
   <label for="pinterest">Pinterest account: </label>
   <input type="text" class="form-control" id="pinterest" placeholder="http://pinterest/account" name="pinterest" value="' . $row['pinterest'] . '">
 </div>


 <button type="submit" class="btn btn-default">Submit</button>
</form>';
?>


<?php
require_once "footer.php";
?>