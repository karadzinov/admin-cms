<?php require_once "header.php";
echo '<h4 class="naslov" >Додади Превземање</h4>';
$adddownload = $_POST['adddownload'];
if(isset($adddownload) && $adddownload === "adddownload") {
    $cat_id = $_POST['cat_id'];
    $cat_id = implode(',',$cat_id);
    $title = htmlspecialchars_decode($_POST['title']);
    $image = $_POST['image'];
    $image_thumb = $_POST['imagethumb'];
    $link = $_POST['link'];
    $artists = $_POST['artists'];
    $action = adddownloads($title,$cat_id,$image,$image_thumb,$link,$artists);
    if($action === "success") {
        echo '<p class="center">Download with title: <button class="btn btn-xs btn-info">' . $title . '</button> is successfully inserted to database <a href="/listdownloads">Continue</a><p>';
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
    <input type="hidden" name="adddownload" value="adddownload" />
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
        category_select('0','74');
        echo '</select>';
        ?>
    </div>

    <div class="form-group">
        <label for="inputNaslov">Наслов: </label>
        <input type="text" class="form-control" id="inputNaslov" placeholder="Внеси наслов" name="title">
    </div>

    <div class="form-group">
        <label for="link">Линк: </label>
        <input type="text" class="form-control" id="link" placeholder="Внеси линк" name="link">
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

<button type="submit" class="btn btn-default">Submit</button>
</form>
<?php require_once "footer.php"; ?>