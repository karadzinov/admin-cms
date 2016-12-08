<?php require_once "header.php";

echo '<h4 class="naslov" >Add page</h4>';
$addpage = $_POST['addpage'];
if(isset($addpage) && $addpage === "addpage") {
  $title = $_POST['title'];
  $userid = $_POST['userid'];
  $text = $_POST['text'];
  $embed = $_POST['embed'];
  $keywords = $_POST['keywords'];
  $image_thumb = $_POST['imagethumb'];
  $image = $_POST['image'];
  $sliderid = $_POST['sliderid'];
  $mainpage = $_POST['mainpage'];

  $action = addpage($title, $userid, $text, $embed, $keywords, $image_thumb, $image, $mainpage, $sliderid);
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



<form action="" method="post" id="stylebrand" >
  <input type="hidden" name="addpage" value="addpage" />
  <?php 
  $name = $_SESSION['name'];
  $dbquery = mysqli_query($con,"SELECT * FROM users WHERE user_name = '$name'");
  $row = mysqli_fetch_array($dbquery);
  $userid = $row['user_id'];
  echo '<input type="hidden" name="userid" value="'.$userid.'" />';
  ?>
  <br />
  <div id="upload_status"></div>
  <br />

  <div class="form-group">
   <label for="inputNaslov">Title: </label>
   <input type="text" class="form-control" id="inputNaslov" placeholder="Page Title" name="title">
 </div>

 <div class="form-group">
   <label for="sliderid">Select slider: </label>
   <select type="select" class="form-control" id="sliderid" name="sliderid">
     <option value="0" selected>-- Without Slider --</option>
     <?php
     $dbquery = mysqli_query($con, "SELECT * FROM sliders");
     while($row = mysqli_fetch_array($dbquery)) {
      echo '<option value="'.$row['id'].'">'.$row['title'].'</option>';
    }
    ?>
  </select>
</div>

<div class="form-group">
 <label for="tags">Tags: </label>
 <input type="text" class="form-control" id="tags" data-role="tagsinput" name="keywords" value="page, static">
</div>

<div class="form-group">
  <label for="embed">Paste embeded code: </label>
  <textarea class="form-control" id="embed" name="embed" placeholder="<embed></embed>" style="min-width: 100%; min-height: 100px;"></textarea>
</div>


<div class="form-group">
  <label for="frontpage">Show on menu:</label>
  <input type="checkbox" name="mainpage" id="mainpage"><br />
</div>

<div class="form-group">
  <laber for="text">Page content:</laber>
  <textarea class="ckeditor" name="text" id="text"></textarea>
</div>






<button type="submit" class="btn btn-default">Submit</button>
</form>     

<?php require_once "footer.php"; ?>