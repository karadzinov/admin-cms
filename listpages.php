<?php
ob_clean();
require_once 'header.php'; ?>
<p class="naslov" >
  <?php
echo '<h4 class="naslov" >List Pages</h4>';


  $delete = $_POST['delete'];
  $pageid = $_POST['pageid'];
  $title = $_POST['pagetitle'];
  if($delete === "delete") {
    $action = deletepage($pageid);
    if($action === "success") {
      echo '<p class="center">Page with title: <button class="btn btn-xs btn-info">' . $title . '</button> is successfully deleted <a href="/listpages">Continue</a><p>';
    }
  }
  ?>
</p>


<table class="table">
  <thead>
    <tr>
      <th>Title</th>
      <th>Date</th>
      <th>Tags</th>
      <th>Short URL</th>
      <th>User</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
    <?php 

    $dbquery = mysqli_query($con,"SELECT * FROM page INNER JOIN users ON page.userid = users.user_id ORDER BY 'timestamp' DESC");
    while($row = mysqli_fetch_array($dbquery)) {

      $keywords = $row['keywords'];
      $keywords = explode(",", $keywords);

      foreach ($keywords as $key => $value) {
        if($value != NULL) {
          $tags .= '<button class="btn btn-xs btn-info"> '.$value.' </button> &nbsp;';
        }
      }

      $date = date('d-M-Y H:i',strtotime($row['timestamp']));
      echo '
      <tr>
        <td>'.$row['title'].'</td>
        <td>'.$date.'</td>
        <td>'.$tags.'</td>
        <td>'.$row['url'].'</td>
        <td>'.$row['user_name'].' '.$row['user_lastname'].'</td>
        <td>
         <form action="editpage" method="post" role="form">
           <input type="hidden" name="pageid" value="'.$row['pageid'].'">
           <input type="hidden" name="pagetitle" value="'.$row['title'].'">
           <button class="btn btn-warning btn-xs"> <span class="glyphicon glyphicon-edit"> </span>  Edit page </button>
         </form>
       </td>
       <td>
         <form action="" method="post" role="form">
           <input type="hidden" name="pageid" value="'.$row['pageid'].'">
           <input type="hidden" name="pagetitle" value="'.$row['title'].'">
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
