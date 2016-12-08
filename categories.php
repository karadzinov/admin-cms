<?php
require_once 'header.php'; 
echo '<h4 class="naslov" >Add category</h4>';
?>

<?php
$add = $_POST['addcategory'];
$title = $_POST['title'];
$parent_id = $_POST['parent_id'];
$delete = $_POST['delete'];
$cat_id = $_POST['cat_id'];
if(isset($add) && $add == "addcategory") {

$action = addcategory($title,$parent_id);
  if($action === "success") {
    echo '<p class="center">Category with title: <button class="btn btn-xs btn-info">' . $title . '</button> is successfully inserted to database <a href="/categories">Continue</a><p>';
  }
}
if(isset($delete) && $delete == "delete") {
    $action = deletecategory($cat_id);
    if($action === "success") {
          echo '<p class="center">Category with title: <button class="btn btn-xs btn-info">' . $title . '</button> is successfully deleted to database <a href="/categories">Continue</a><p>';
    }
}

?>

<form action="" method="post" >
<input type="hidden" value="addcategory" name="addcategory" />
    <div class="form-group">
        <label for="category">Select category: </label>
<?php
        echo '<select name="parent_id" class="form-control" id="category" type="select">
        <option value="0">Main Category</option>
        ';
        category_select();
        echo '</select>';
?>
    </div>

    <div class="form-group">
        <label for="inputNaslov"><?php echo CAT_NAME; ?> </label>
        <input type="text" class="form-control" id="inputNaslov" placeholder="<?php echo ENTER_TITLE; ?>" name="title">
    </div>
    <br />
    <button type="submit" class="btn btn-default">Submit</button>
</form>
<br />
<br />





<table class="table">
<thead>
<tr>
<th>Category Name</th>
<th>Short url</th>
<th class="right">Delete</th>
</tr>
</thead>
<tbody>
<?php
    category_tree_form();
?>
</tbody>
</table>


<hr />
<h4>Category tree</h4>
<?php

category_tree();

?>

<?php
require_once 'footer.php'; ?>