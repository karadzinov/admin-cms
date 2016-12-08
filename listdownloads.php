<?php
ob_clean();
require_once 'header.php'; 
echo '<h4 class="naslov" >Превземања</h4>';
?>
<p class="naslov" >
  <?php

  $delete = $_POST['delete'];
  $downloadid = $_POST['downloadid'];
  $title = $_POST['downloadtitle'];
  if($delete === "delete") {
    $action = deletedownload($downloadid);
    if($action === "success") {
      echo '<p class="center">download with title: <button class="btn btn-xs btn-info">' . $title . '</button> is successfully deleted <a href="/listdownloads">Continue</a><p>';
    }
  }
  ?>
</p>


<table class="table tablesorter" id="downloadstable">
  <thead>
    <tr>
      <th>Title</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
    <?php 

    $dbquery = mysqli_query($con,"SELECT * FROM downloads");
    while($row = mysqli_fetch_array($dbquery)) {

     
      if($row['cat_id'] == 0) {
        $url = "default";
      }
      else {
        $url = getelement("cat_url","categories","id",$row['cat_id']);
      }
      
      $url = $url."/".$row['url'];
      $category = getelement("title","categories","id",$row['cat_id']);
      if($category == "") {
        $category = "Main category";
      }
      echo '
      <tr>
        <td>'.$row['title'].'</td>
        <td>
         <form action="editdownloads" method="post" role="form">
           <input type="hidden" name="downloadid" value="'.$row['id'].'">
           <input type="hidden" name="downloadtitle" value="'.$row['title'].'">
           <button class="btn btn-warning btn-xs"> <span class="glyphicon glyphicon-edit"> </span> Edit download </button>
         </form>
       </td>
       <td>
         <form action="" method="post" role="form">
           <input type="hidden" name="downloadid" value="'.$row['id'].'">
           <input type="hidden" name="downloadtitle" value="'.$row['title'].'">
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
