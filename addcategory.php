<? require_once 'header.php'; ?>

<form action="process/processcategory.php" method="post" >

    <div class="form-group">
        <label for="inputNaslov"><?php echo CAT_NAME; ?> </label>
        <input type="text" class="form-control" id="inputNaslov" placeholder="<?php echo ENTER_TITLE; ?>" name="name">
    </div>
    <br />
   
    <button type="submit" class="btn btn-default">Submit</button>
</form>    
<br />
<br />

<table class="table">
<tr>
<th>ID</th>
<th>Category Name</th>
<th>Delete</th>
</tr>
<?php

$dbquery = mysqli_query($con, "SELECT * FROM categories");
while($row = mysqli_fetch_array($dbquery)) {
    $id = $row['id'];
    echo "<tr>";
    echo '
    <td>'.$id.'</td>
    <td>'.$row['cat_name'].'</td>
    <td><a href="process/deletecategory.php?id='.$id.'" class="btn btn-small btn-danger">Delete</a></td>

    ';
    echo "</tr>";
}

?>
</table>
<? require_once 'footer.php'; ?>