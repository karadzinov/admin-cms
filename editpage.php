<?php require_once "header.php";


$delete = $_POST['delete'];
$pageid = $_POST['pageid'];
$title = $_POST['pagetitle'];
$editpage = $_POST['editpage'];

$dbquery = mysqli_query($con,"SELECT * FROM page WHERE pageid = '$pageid'");
$row = mysqli_fetch_array($dbquery);

if(isset($editpage) && $editpage === "editpage") {
  $title = $_POST['title'];
  $userid = $_POST['userid'];
  $text = $_POST['text'];
  $embed = $_POST['embed'];
  $keywords = $_POST['keywords'];
  $image_thumb = $_POST['imagethumb'];
  $image = $_POST['image'];
  $sliderid = $_POST['sliderid'];
  $mainpage = $_POST['mainpage'];

  $action = updatepage($title, $userid, $text, $embed, $keywords, $image_thumb, $image, $mainpage, $sliderid, $pageid);
  if($action === "success") {
    echo '<p class="center">Page with title: <button class="btn btn-xs btn-info">' . $title . '</button> is successfully inserted to database <a href="/listpages">Continue</a><p>';
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


<p style="text-align: center; margin: 0 auto;">
  <br />
  <?php

  if($row['image'] != "") {
    echo '<img src="http://admin.dns.mk/'.$row['image'].'" alt="'.$row['title'].'" class="img-responsive" />';
  }
  ?>
</p>

<form action="" method="post" id="stylebrand" >
  <input type="hidden" name="editpage" value="editpage" />

  <?php 


  echo '<input type="hidden" name="pageid" value="'.$row['pageid'].'" />';


  $name = $_SESSION['name'];
  $dbquery = mysqli_query($con,"SELECT * FROM users WHERE user_name = '$name'");
  $row_s = mysqli_fetch_array($dbquery);
  $userid = $row_s['user_id'];
  echo '<input type="hidden" name="userid" value="'.$userid.'" />';


  echo '
  <br />
  <div id="upload_status"></div>
  <br />

  <div class="form-group">
   <label for="inputNaslov">Title: </label>

   <input type="text" class="form-control" id="inputNaslov" placeholder="Page Title" name="title" value="'.$row['title'].'">

 </div>

 <div class="form-group">
   <label for="sliderid">Select slider: </label>
   <select type="select" class="form-control" id="sliderid" name="sliderid">
     <option value="0">-- Without Slider --</option>
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
 <label for="tags">Tags: </label>
 <input type="text" class="form-control" id="tags" data-role="tagsinput" name="keywords"  value="'.$row['keywords'].'">
</div>

<div class="form-group">
  <label for="embed">Paste embeded code: </label>
  <textarea class="form-control" id="embed" name="embed" placeholder="<embed></embed>" style="min-width: 100%; min-height: 100px;">'.$row['embed'].'</textarea>
</div>


<div class="form-group">
  <label for="frontpage">Show on menu:</label>
  ';
if($row['mainpage'] == 1) {
  $checked = "checked";
}
  echo '
  <input type="checkbox" name="mainpage" id="mainpage" '.$checked.'><br />
</div>




<div class="form-group">
  <laber for="pagecontent">Page content:</laber>
  <textarea class="ckeditor" name="text" id="pagecontent">'.$row['text'].'</textarea>
</div>






<button type="submit" class="btn btn-default">Submit</button>
</form>     ';

require_once "footer.php"; 

?>