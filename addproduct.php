<?php require_once "header.php";
echo '<h4 class="naslov" >Додади пост</h4>';

$addproduct = $_POST['addproduct'];
if(isset($addproduct) && $addproduct === "addproduct") {
  $artists = htmlspecialchars_decode($_POST['artists']);
  $cat_id = $_POST['cat_id'];
  $cat_id = implode(',',$cat_id);
  $title = htmlspecialchars_decode($_POST['title']);
  $userid = $_POST['userid'];
  $text = htmlspecialchars_decode($_POST['text']);
  $keywords = htmlspecialchars_decode($_POST['keywords']);
  $image_thumb = $_POST['imagethumb'];
  $image = $_POST['image'];
  $link = $_POST['link'];
  $price = $_POST['price'];
  $percent = $_POST['percent'];
  $sliderid = $_POST['sliderid'];
  $embed = $_POST['embed'];


  $action = addproduct($title, $userid, $text, $keywords, $artists, $link, $cat_id, $image_thumb, $image, $sliderid, $embed);
  if($action === "success") {
    echo '<p class="center">product with title: <button class="btn btn-xs btn-info">' . $title . '</button> is successfully inserted to database <a href="/listproducts">Continue</a><p>';
  }
}

?>


<form id="file_form" method="post" enctype="multipart/form-data" action="javascript:void(0);" autocomplete="on">
  <label for="browsed_file">Прикачи слика: </label>
  <span class="btn btn-warning btn-file">
    <input type="file" name="browsed_file" id="browsed_file" href="javascript:void(0);" onchange="upload_fn();">
    <span class="glyphicon glyphicon-picture"> </span>  Browse
  </span>
</form>



<form action="" method="post" id="stylebrand" >
  <input type="hidden" name="addproduct" value="addproduct" />
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
   <label for="inputNaslov">Наслов: </label>
   <input type="text" class="form-control" id="inputNaslov" placeholder="Внеси наслов" name="title">
 </div>


 <div class="form-group">
  <label for="category">Избери една или повеќе категории: </label>
  <?php
  echo '<select name="cat_id[]" class="form-control" id="category" type="select" multiple>
  ';
  category_select();
  echo '</select>';
  ?>
</div>


<div class="form-group">
 <label for="sliderid">Избери слајдер: </label>
 <select type="select" class="form-control" id="sliderid" name="sliderid">
   <option value="0" selected>-- Без слајдер --</option>
   <?php 
   $dbquery = mysqli_query($con, "SELECT * FROM sliders");
   while($row = mysqli_fetch_array($dbquery)) {
    echo '<option value="'.$row['id'].'">'.$row['title'].'</option>';
  }
  ?>
</select>
</div>





<div class="form-group">
  <label for="embed">Додади embeded code: </label>
  <textarea class="form-control" id="embed" name="embed" placeholder="<embed></embed>" style="min-width: 100%; min-height: 100px;"></textarea>
</div>


<div class="form-group">
 <label for="tags">Tags: </label>
 <input type="text" class="form-control" id="tags" data-role="tagsinput" name="keywords" value="">
</div>

<div class="form-group">
 <label for="artists">Артист/Група: </label>
 <select type="select" class="form-control" id="artists" name="artists">
   <option value="0">- Без артист -</option>
   <?php 
   $dbquery = mysqli_query($con,"SELECT * FROM artists");
   while($row = mysqli_fetch_array($dbquery)) {
    echo '<option value="'.$row['id'].'">'.$row['title'].'</option>';
  }
  ?>
</select>

</div>

<div class="form-group">
  <laber for="productcontent">Текст:</laber>
  <textarea class="ckeditor" name="text" id="text"></textarea>
</div>






<button type="submit" class="btn btn-default">Submit</button>
</form>     

<?php require_once "footer.php"; ?>