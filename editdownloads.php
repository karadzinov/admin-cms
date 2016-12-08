<?php
require_once "header.php";
echo '<h4 class="naslov" >Уреди Превземање</h4>';
$id = $_POST['downloadid'];
$title = htmlspecialchars_decode($POST['title']);

$dbquery = mysqli_query($con, "SELECT * FROM downloads WHERE id = '$id'");
$row = mysqli_fetch_array($dbquery);

$editdownload = $_POST['editdownload'];
if (isset($editdownload) && $editdownload === "editdownload") {
    $cat_id = $_POST['cat_id'];
    $cat_id = implode(',',$cat_id);
    $title = htmlspecialchars_decode($_POST['title']);
    $image = $_POST['image'];
    $image_thumb = $_POST['imagethumb'];
    $link = $_POST['link'];
    $id = $_POST['id'];
    $artists = $_POST['artists'];
    $action = editdownloads($id, $cat_id, $title, $image, $image_thumb, $link, $artists);
    if ($action === "success") {
        echo '<p class="center">Artist with title: <button class="btn btn-xs btn-info">' . $title . '</button> is successfully updated to database <a href="/listartists">Continue</a><p>';
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

<p style="text-align: center; margin: 0 auto;">
  <br />
  <?php
  if ($row['image'] != "") {
    echo '<img src="http://admin.dns.mk/' . $row['image_thumb'] . '" alt="' . $row['title'] . '" class="img-responsive" />';
}
?>
</p>

<?php
echo '

<form action="" method="post" id="stylebrand" >
    <div id="upload_status"></div>
    <br />



    <input type="hidden" name="editdownload" value="editdownload" />



    <div class="form-group">
      <label for="category">Select category: </label>';

      echo '<select name="cat_id[]" class="form-control" id="category" type="select" multiple="multiple">
      <option value="54">МК Хип-Хоп</option>
      ';
      category_select_downloads($row['id'],'74');
      echo '</select>';
      echo '
  </div>

  <input type="hidden" name="id" value="' . $row['id'] . '" />
  <div class="form-group">
    <label for="inputNaslov">Наслов: </label>
    <input type="text" class="form-control" id="inputNaslov" placeholder="Внеси наслов" name="title" value="' . $row['title'] . '">
</div>


<div class="form-group">
    <label for="link">Линк: </label>
    <input type="text" class="form-control" id="link" placeholder="Внеси линк" name="link" value="'.$row['link'].'">
</div>


<div class="form-group">
   <label for="artists">Артист/Група: </label>
   <select type="select" class="form-control" id="artists" name="artists">
     <option value="0">- Без артист -</option>';

     $dbquery = mysqli_query($con,"SELECT * FROM artists");
     while($row_a = mysqli_fetch_array($dbquery)) {
        if($row_a['id'] == $row['artist_id']) {
          $selected = "selected";
      }
      else {
          $selected = "";
      }
      echo '<option value="'.$row_a['id'].'" '.$selected.'>'.$row_a['title'].'</option>';
  }
  echo '
</select>
</div>
<button type="submit" class="btn btn-default">Submit</button>
</form>';
require_once "footer.php";
?>