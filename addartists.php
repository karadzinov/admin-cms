<?php require_once "header.php";
echo '<h4 class="naslov" >Додади Артист/Група</h4>';
$addartist = $_POST['addartist'];
if(isset($addartist) && $addartist === "addartist") {
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
   $youtube = $_POST['youtube'];
   $tekst = htmlspecialchars_decode($_POST['text']);
   $action = addartists($cat_id,$title,$image,$image_thumb,$clenovi,$poteklo,$zanr,$izdavachka_kukja,$email,$facebook,$twitter,$website,$soundcloud,$tekst,$youtube);
   if($action === "success") {
    echo '<p class="center">Artist with title: <button class="btn btn-xs btn-info">' . $title . '</button> is successfully inserted to database <a href="/listartists">Continue</a><p>';
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
    <input type="hidden" name="addartist" value="addartist" />
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
        <label for="category">Избери категорија: </label>
        <?php
        echo '<select name="cat_id[]" class="form-control" id="category" type="select" multiple>
        ';
        category_select('0','54');
        echo '</select>';
        ?>
    </div>

    <div class="form-group">
        <label for="inputNaslov">Артист/Група: </label>
        <input type="text" class="form-control" id="inputNaslov" placeholder="Внеси наслов" name="title">
    </div>
    <div class="form-group">
        <label for="clenovi">Членови: </label>
        <input type="text" class="form-control" id="clenovi" data-role="tagsinput" placeholder="Внеси членови" name="clenovi">
    </div>
    <div class="form-group">
        <label for="poteklo">Потекло: </label>
        <input type="text" class="form-control" id="poteklo" placeholder="Внеси Град / Држава" name="poteklo">
    </div>
    <div class="form-group">
        <label for="zanr">Жанр: </label>
        <input type="text" class="form-control" id="zanr" placeholder="Рап/Хип-Хоп" name="zanr">
    </div>
    <div class="form-group">
        <label for="izdavachka_kukja">Издавачка куќа: </label>
        <input type="text" class="form-control" id="izdavachka_kukja" placeholder="Внеси издавачка куќа" name="izdavachka_kukja">
    </div>
    <hr />
    <p> Контакт информации </p>
    <div class="form-group">
        <label for="email">Email: </label>
        <input type="text" class="form-control" id="email" placeholder="email@address.tld" name="email">
    </div>
    <div class="form-group">
        <label for="facebook">Facebook: </label>
        <input type="text" class="form-control" id="facebook" placeholder="http://facebook.com/artists" name="facebook">
    </div>
    <div class="form-group">
        <label for="twitter">Twitter: </label>
        <input type="text" class="form-control" id="twitter" placeholder="http://twitter.com/artists" name="twitter">
    </div>
    <div class="form-group">
        <label for="website">Website: </label>
        <input type="text" class="form-control" id="website" placeholder="http://www.example.com" name="website">
    </div>
    <div class="form-group">
        <label for="soundcloud">Soundcloud: </label>
        <input type="text" class="form-control" id="soundcloud" placeholder="http://www.soundcloud.com" name="soundcloud">
    </div>
    <div class="form-group">
        <label for="youtube">Youtube: </label>
        <input type="text" class="form-control" id="youtube" placeholder="http://www.youtube.com/artist" name="youtube">
    </div>
    <div class="form-group">
        <laber for="productcontent">Текст:</laber>
        <textarea class="ckeditor" name="text" id="text"></textarea>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
</form>
<?php require_once "footer.php"; ?>