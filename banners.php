<?php
ob_clean();
require_once 'header.php';

$addbanner = $_POST['addbanner'];
$delete = $_POST['delete'];
$bannerid = $_POST['bannerid'];
$bannertitle = $_POST['bannertitle'];
$edit = $_POST['edit'];
$editbanner = $_POST['editbanner'];
$content = $_POST['content'];
$id = $_POST['id'];
echo '<h4 class="naslov" >Banners</h4>';

if (isset($delete) && $delete == "delete") {
    $action = deletebanner($bannerid);
    if ($action === "success") {
        echo '<p class="center">Banner with title: <button class="btn btn-xs btn-info">' . $bannertitle . '</button> is successfully deleted from database <a href="/banners">Continue</a><p>';
    }
}

if (isset($addbanner) && $addbanner === "addbanner") {
    $title = $_POST['bannertitle'];
    $action = addbanner($title, $content);
    if ($action == "success") {
        echo '<p class="center">Banner with title: <button class="btn btn-xs btn-info">' . $title . '</button> is successfully added to database <a href="/banners">Continue</a><p>';
    }
}

if (isset($editbanner) && $editbanner === "editbanner") {
    $id = $_POST['id'];
    $action = updatebanner($id, $bannertitle, $content);
    if ($action == "success") {
        echo '<p class="center">Banner with title: <button class="btn btn-xs btn-info">' . $bannertitle . '</button> is successfully edited to database <a href="/banners">Continue</a><p>';
    }
}

echo '
<table class="table">
  <thead>
    <tr>
      <th>Banner Name</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>';

$dbquery = mysqli_query($con, "SELECT * FROM banners");
while ($row = mysqli_fetch_array($dbquery)) {
    
    $bannerid = $row['id'];
    
    echo '
      <tr>
        <td>' . $row['title'] . '</td>
        <td>
       <form action="/banners" method="post" role="form">
        <input type="hidden" name="bannerid" value="' . $bannerid . '">
        <input type="hidden" name="bannertitle" value="' . $row['title'] . '">
        <input type="hidden" name="edit" value="edit"  />
        <button class="btn btn-warning btn-xs"> Edit </button>
      </form>
    </td>
      <td>
       <form action="/banners" method="post" role="form">
        <input type="hidden" name="bannerid" value="' . $bannerid . '">
        <input type="hidden" name="bannertitle" value="' . $row['title'] . '">
        <input type="hidden" name="delete" value="delete"  />
        <button class="btn btn-danger btn-xs"> Delete </button>
      </form>
    </td>


  </tr>
  ';
}

echo '
</tbody>
</table>
';

echo '
<p class="naslov">
  <form action="" method="post">
    <input type="hidden" name="addbanner" value="1" />
    <button type="subbmit" class="btn btn-info">
      <span class="glyphicon glyphicon-plus-sign"> </span> Add banner</button>
    </form>
  </p>';

if (isset($addbanner)) {
    echo '
    <div class="col-md-4">
      <div class="form-group">
        <form action="/banners" method="post" role="form">
          <input type="hidden" name="addbanner" value="addbanner"  />
          <label for="bannername">Enter banner name:</label>
          <input type="text" class="form-control" name="bannertitle" id="bannertitle" />
          <br />

          <div class="form-group">
          <label for="content">Paste embeded code: </label>
           <textarea class="form-control" id="content" name="content" placeholder="<embed></embed>" style="min-width: 100%; min-height: 100px;"></textarea>
          </div>
          <button type="submit" class="btn btn-default">Submit</button> 
        </form>
      </div>
    </div>
    ';
}

if (isset($edit) && $edit == "edit") {
  $id = $_POST['bannerid'];
  $dbquery = mysqli_query($con, "SELECT * FROM banners WHERE id = '$id'");
  $row = mysqli_fetch_array($dbquery);
    echo '
    <div class="col-md-4">
      <div class="form-group">
        <form action="/banners" method="post" role="form">
          <input type="hidden" name="editbanner" value="editbanner"  />
          <label for="bannername">Enter banner name:</label>
          <input type="text" class="form-control" name="bannertitle" id="bannertitle" value="' . $row['title'] . '"/>
                    <div class="form-group">
          <label for="content">Paste embeded code: </label>
           <textarea class="form-control" id="content" name="content" placeholder="<embed></embed>" style="min-width: 100%; min-height: 100px;">'.$row['content'].'</textarea>
          </div>
          <br />
          ';

    echo '
          <input type="hidden" name="id" value="' . $row['id'] . '" />
          <button type="submit" class="btn btn-default">Submit</button> 
        </form>
      </div>
    </div>
    ';
}

require_once 'footer.php';
?>
