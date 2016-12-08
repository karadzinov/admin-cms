<?php
require_once "header.php";
echo '<h4 class="naslov" >Уреди Артист/Група</h4>';
$id = $_POST['id'];
$title = $POST['title'];

$dbquery = mysqli_query($con, "SELECT * FROM artists WHERE id = '$id'");
$row = mysqli_fetch_array($dbquery);

$editartist = $_POST['editartist'];
if (isset($editartist) && $editartist === "editartist") {
    $cat_id = $_POST['cat_id'];
    $cat_id = implode(',',$cat_id);
    $title = htmlspecialchars_decode($_POST['title']);
    $image = $_POST['image'];
    $image_thumb = $_POST['imagethumb'];
    $clenovi = htmlspecialchars_decode($_POST['clenovi']);
    $poteklo = htmlspecialchars_decode($_POST['poteklo']);
    $zanr = htmlspecialchars_decode($_POST['zanr']);
    $izdavachka_kukja = htmlspecialchars_decode($_POST['izdavachka_kukja']);
    $email = htmlspecialchars_decode($_POST['email']);
    $facebook = $_POST['facebook'];
    $twitter = $_POST['twitter'];
    $website = $_POST['website'];
    $soundcloud = $_POST['soundcloud'];
    $tekst = htmlspecialchars_decode($_POST['text']);
    $youtube = $_POST['youtube'];
    $id = $_POST['id'];
    $action = editartist($id, $cat_id, $title, $image, $image_thumb, $clenovi, $poteklo, $zanr, $izdavachka_kukja, $email, $facebook, $twitter, $website, $soundcloud, $tekst, $youtube);
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



    <input type="hidden" name="editartist" value="editartist" />



    <div class="form-group">
      <label for="category">Select category: </label>';

      echo '<select name="cat_id[]" class="form-control" id="category" type="select" multiple="multiple">
      <option value="54">МК Хип-Хоп</option>
      ';
      category_select($row['id'],'54');
      echo '</select>';
      echo '
  </div>

  <input type="hidden" name="id" value="' . $row['id'] . '" />
  <div class="form-group">
    <label for="inputNaslov">Артист/Група: </label>
    <input type="text" class="form-control" id="inputNaslov" placeholder="Внеси наслов" name="title" value="' . $row['title'] . '">
</div>
<div class="form-group">
    <label for="clenovi">Членови: </label>
    <input type="text" class="form-control" id="clenovi" data-role="tagsinput" placeholder="Внеси членови" name="clenovi" value="' . $row['clenovi'] . '">
</div>
<div class="form-group">
    <label for="poteklo">Потекло: </label>
    <input type="text" class="form-control" id="poteklo" placeholder="Внеси Град / Држава" name="poteklo" value="' . $row['poteklo'] . '">
</div>
<div class="form-group">
    <label for="zanr">Жанр: </label>
    <input type="text" class="form-control" id="zanr" placeholder="Рап/Хип-Хоп" name="zanr" value="' . $row['zanr'] . '">
</div>
<div class="form-group">
    <label for="izdavachka_kukja">Издавачка куќа: </label>
    <input type="text" class="form-control" id="izdavachka_kukja" placeholder="Внеси издавачка куќа" name="izdavachka_kukja" value="' . $row['izdavachka_kukja'] . '">
</div>
<hr />
<p> Контакт информации </p>
<div class="form-group">
    <label for="email">Email: </label>
    <input type="text" class="form-control" id="email" placeholder="email@address.tld" name="email" value="' . $row['email'] . '">
</div>
<div class="form-group">
    <label for="facebook">Facebook: </label>
    <input type="text" class="form-control" id="facebook" placeholder="http://facebook.com/artists" name="facebook" value="' . $row['facebook'] . '">
</div>
<div class="form-group">
    <label for="twitter">Twitter: </label>
    <input type="text" class="form-control" id="twitter" placeholder="http://twitter.com/artists" name="twitter" value="' . $row['twitter'] . '">
</div>
<div class="form-group">
    <label for="website">Website: </label>
    <input type="text" class="form-control" id="website" placeholder="http://www.example.com" name="website" value="' . $row['website'] . '">
</div>

<div class="form-group">
    <label for="Soundcloud">Soundcloud: </label>
    <input type="text" class="form-control" id="soundcloud" placeholder="http://www.soundcloud.com" name="soundcloud" value="' . $row['soundcloud'] . '">
</div>

<div class="form-group">
    <label for="Youtube">Youtube: </label>
    <input type="text" class="form-control" id="Youtube" placeholder="http://www.youtube.com/artist" name="youtube" value="' . $row['youtube'] . '">
</div>

<div class="form-group">
    <laber for="productcontent">Текст:</laber>
    <textarea class="ckeditor" name="text" id="text">' . $row['tekst'] . '</textarea>
</div>
<button type="submit" class="btn btn-default">Submit</button>
</form>';
require_once "footer.php";
?>