<?php
ob_clean();
require_once 'header.php'; ?>
<p class="naslov" >
  <?php
echo '<h4 class="naslov" >Артисти / Групи</h4>';


  $delete = $_POST['delete'];
  $id = $_POST['id'];
  $title = $_POST['title'];
  if($delete === "delete") {
    $action = deleteartist($id);
    if($action === "success") {
      echo '<p class="center">Group/Artist with title: <button class="btn btn-xs btn-info">' . $title . '</button> is successfully deleted <a href="/sliders">Continue</a><p>';
    }
  }
  ?>
</p>


<table class="table tablesorter" id="artiststable">
  <thead>
    <tr>
      <th>Title</th>
      <th>Short URL</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
    <?php 

    $dbquery = mysqli_query($con,"SELECT * FROM artists");
    while($row = mysqli_fetch_array($dbquery)) {


      echo '
      <tr>
        <td>'.$row['title'].'</td>
        <td>'.$row['url'].'</td>
        <td>
         <form action="editartists" method="post" role="form">
           <input type="hidden" name="id" value="'.$row['id'].'">
           <input type="hidden" name="title" value="'.$row['title'].'">
           <button class="btn btn-warning btn-xs"> <span class="glyphicon glyphicon-edit"> </span>  Edit  </button>
         </form>
       </td>
       <td>
         <form action="" method="post" role="form">
           <input type="hidden" name="id" value="'.$row['id'].'">
           <input type="hidden" name="title" value="'.$row['title'].'">
           <input type="hidden" name="delete" value="delete"  />
           <button class="btn btn-danger btn-xs"> <span class="glyphicon glyphicon-delete"> </span> Delete </button>
         </form>
       </td>
     </tr>';
     $tags = "";
   }


   ?>
 </tbody>
</table>
<?php require_once 'footer.php'; ?>
