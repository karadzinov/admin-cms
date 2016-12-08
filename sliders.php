<?php
ob_clean();
require_once 'header.php';

$addslider = $_POST['addslider'];
$frontpage = $_POST['mainslider'];
$delete = $_POST['delete'];
$sliderid = $_POST['sliderid'];
$slidertitle = $_POST['slidertitle'];
$edit = $_POST['edit'];
$editslider = $_POST['editslider'];

echo '<h4 class="naslov" >Sliders</h4>';

if (isset($delete) && $delete == "delete") {
    $action = deleteslider($sliderid);
    if ($action === "success") {
        echo '<p class="center">Slider with title: <button class="btn btn-xs btn-info">' . $slidertitle . '</button> is successfully deleted from database <a href="/sliders">Continue</a><p>';
    }
}

if (isset($addslider) && $addslider === "addslider") {
    $title = $_POST['slidertitle'];
    $action = addslider($title, $frontpage);
    if ($action == "success") {
        echo '<p class="center">Slider with title: <button class="btn btn-xs btn-info">' . $title . '</button> is successfully added to database <a href="/sliders">Continue</a><p>';
    }
}

if(isset($editslider) && $editslider === "editslider") {
  $id = $_POST['id'];
    $action = updateslider($slidertitle, $frontpage, $id);
    if ($action == "success") {
        echo '<p class="center">Slider with title: <button class="btn btn-xs btn-info">' . $slidertitle . '</button> is successfully edited to database <a href="/sliders">Continue</a><p>';
    }
}


echo '
<table class="table">
  <thead>
    <tr>
      <th>Slider Name</th>
      <th>Total Images</th>
      <th>Images</th>
      <th>Show on frontpage</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>';

$dbquery = mysqli_query($con, "SELECT * FROM sliders LEFT JOIN slider_images ON sliders.id = slider_images.sliderid GROUP BY sliders.id");
while ($row = mysqli_fetch_array($dbquery)) {
    
    $sliderid = $row['id'];
    $totalimages = count_images($sliderid);
    if ($row['mainslider'] == 1) {
        $mainslider = "True";
    } 
    else {
        $mainslider = "False";
    }
    
    echo '
      <tr>
        <td>' . $row['title'] . '</td>
        <td>' . $totalimages . '</td>
        <td>
         <form action="/addimages" method="post" role="form">
          <input type="hidden" name="sliderid" value="' . $sliderid . '">
          <input type="hidden" name="slidertitle" value="' . $row['title'] . '">
          <button class="btn btn-info btn-xs"> <span class="glyphicon glyphicon-picture"> </span>  View images </button>
        </form>
      </td>
      <td>
        ' . $mainslider . '
      </td>
          <td>
       <form action="/sliders" method="post" role="form">
        <input type="hidden" name="sliderid" value="' . $sliderid . '">
        <input type="hidden" name="slidertitle" value="' . $row['title'] . '">
        <input type="hidden" name="mainslider" value="'.$row['mainslider'].'">
        <input type="hidden" name="edit" value="edit"  />
        <button class="btn btn-warning btn-xs"> Edit </button>
      </form>
    </td>
      <td>
       <form action="/sliders" method="post" role="form">
        <input type="hidden" name="sliderid" value="' . $sliderid . '">
        <input type="hidden" name="slidertitle" value="' . $row['title'] . '">
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
    <input type="hidden" name="addslider" value="1" />
    <button type="subbmit" class="btn btn-info">
      <span class="glyphicon glyphicon-plus-sign"> </span> Add Slider</button>
    </form>
  </p>';

if (isset($addslider)) {
    echo '
    <div class="col-md-4">
      <div class="form-group">
        <form action="/sliders" method="post" role="form">
          <input type="hidden" name="addslider" value="addslider"  />
          <label for="slidername">Enter slider name:</label>
          <input type="text" class="form-control" name="slidertitle" id="slidertitle" />
          <br />

          <label for="frontpage">Show on frontpage</label>
          <input type="checkbox" name="mainslider" id="frontpage" ><br />
          <button type="submit" class="btn btn-default">Submit</button> 
        </form>
      </div>
    </div>
    ';
}

if(isset($edit) && $edit == "edit") {
 echo '
    <div class="col-md-4">
      <div class="form-group">
        <form action="/sliders" method="post" role="form">
          <input type="hidden" name="editslider" value="editslider"  />
          <label for="slidername">Enter slider name:</label>
          <input type="text" class="form-control" name="slidertitle" id="slidertitle" value="'.$slidertitle.'"/>
          <br />
          ';
          if($frontpage == 1) {
            $checked = "checked";
          }
          else {
            $checked = "";
          }
          echo '
          <label for="frontpage" >Show on frontpage</label>
          <input type="hidden" name="id" value="'.$_POST['sliderid'].'" />
          <input type="checkbox" name="mainslider" id="frontpage" '.$checked.'><br />
          <button type="submit" class="btn btn-default">Submit</button> 
        </form>
      </div>
    </div>
    ';
}

require_once 'footer.php';
?>
