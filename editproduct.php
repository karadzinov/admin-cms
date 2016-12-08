<?php
require_once "header.php";

$delete = $_POST['delete'];
$productid = $_POST['productid'];
$title = htmlspecialchars_decode($_POST['producttitle']);
$editproduct = $_POST['editproduct'];

$dbquery = mysqli_query($con, "SELECT * FROM product WHERE id = '$productid'");
$row = mysqli_fetch_array($dbquery);

if (isset($editproduct) && $editproduct === "editproduct") {
  $title = htmlspecialchars_decode($_POST['title']);
  $artists = htmlspecialchars_decode($_POST['artists']);
  $userid = $_POST['userid'];
  $text = htmlspecialchars_decode($_POST['text']);
  $link = $_POST['link'];
  $keywords = htmlspecialchars_decode($_POST['keywords']);
  $image_thumb = $_POST['imagethumb'];
  $image = $_POST['image'];
  $cat_id = $_POST['cat_id'];
  $cat_id = implode(',',$cat_id);



  $action = updateproduct($title, $userid, $text, $keywords, $artists, $image_thumb, $image, $embed, $sliderid, $link, $cat_id, $productid);
  if ($action === "success") {
    echo '<p class="center">product with title: <button class="btn btn-xs btn-info">' . $title . '</button> is successfully inserted to database <a href="/listproducts">Continue</a><p>';
  }
}
?>


<form id="file_form" method="post" enctype="multipart/form-data" action="javascript:void(0);" autocomplete="on">
  <label for="browsed_file">Upload main image: </label>
  <span class="btn btn-warning btn-file">
    <input type="file" name="browsed_file" id="browsed_file" href="javascript:void(0);" onchange="upload_fn();">
    <span class="glyphicon glyphicon-picture"> </span>  Browse
  </span>
</form>


<p style="text-align: center;">
  <br />
  <?php
  if ($row['image'] != "") {
    echo '<img src="http://admin.dns.mk/' . $row['image_thumb'] . '" alt="' . $row['title'] . '" class="img-responsive" />';
  }
  ?>
</p>

<form action="" method="post" id="stylebrand" >
  <input type="hidden" name="editproduct" value="editproduct" />

  <?php

  echo '<input type="hidden" name="productid" value="' . $row['id'] . '" />';

  $name = $_SESSION['name'];
  $dbquery = mysqli_query($con, "SELECT * FROM users WHERE user_name = '$name'");
  $row_s = mysqli_fetch_array($dbquery);
  $userid = $row_s['user_id'];
  echo '<input type="hidden" name="userid" value="' . $userid . '" />';

  echo '
  <br />
  <div id="upload_status"></div>
  <br />

  <div class="form-group">
   <label for="inputNaslov">Title: </label>

   <input type="text" class="form-control" id="inputNaslov" placeholder="product Title" name="title" value="' . $row['title'] . '">

 </div>

 <div class="form-group">
  <label for="category">Select category: </label>';

  echo '<select name="cat_id[]" class="form-control" id="category" type="select" multiple="multiple">
  <option value="0">Main Category</option>
  ';
  category_select_product($row['id']);
  echo '</select>';
  echo '
</div>

<div class="form-group">
 <label for="tags">Tags: </label>
 <input type="text" class="form-control" id="tags" data-role="tagsinput" name="keywords"  value="' . $row['keywords'] . '">
</div>


<div class="form-group">
 <label for="artists">Артист/Група: </label>
 <select type="select" class="form-control" id="artists" name="artists">
   <option value="0">- Без артист -</option>
';
   $dbquery = mysqli_query($con,"SELECT * FROM artists");
   while($row_a = mysqli_fetch_array($dbquery)) {
    if($row_a['id'] == $row['artists']) {
      $selected = "selected";
    }
    else {
      $selected = "";
    }
    echo '<option value="'.$row_a['id'].'" '.$selected.'>'.$row_a['title'].'</option>';
  }
echo '
</select>

 <div class="form-group">
   <label for="sliderid">Select slider: </label>
   <select type="select" class="form-control" id="sliderid" name="sliderid">
     <option value="0">-- Без Слајдер --</option>
     ';
     $dbquery = mysqli_query($con, "SELECT * FROM sliders");
     while($row_slider = mysqli_fetch_array($dbquery)) {

      if($row['sliderid'] === $row_slider['id']) {
        $selected = "selected";
      }
      else {
        $selected = "";
      }
      echo '<option value="'.$row_slider['id'].'" '.$selected.'>'.$row_slider['title'].'</option>';
    }
    echo '
  </select>
</div>

<div class="form-group">
  <label for="embed">Paste embeded code: </label>
  <textarea class="form-control" id="embed" name="embed" placeholder="<embed></embed>" style="min-width: 100%; min-height: 100px;">'.$row['embed'].'</textarea>
</div>



<div class="form-group">
  <laber for="productcontent">Текст:</laber>
  <textarea class="ckeditor" name="text" id="text">' . $row['text'] . '</textarea>
</div>






<button type="submit" class="btn btn-default">Submit</button>
</form>     ';

require_once "footer.php";
?>