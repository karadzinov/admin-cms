<?php
ob_clean();
require_once 'header.php'; ?>
<p class="naslov" >
  <?php
echo '<h4 class="naslov" >List blogs</h4>';


  $delete = $_POST['delete'];
  $blogid = $_POST['blogid'];
  $title = $_POST['blogtitle'];
  if($delete === "delete") {
    $action = deleteblog($blogid);
    if($action === "success") {
      echo '<p class="center">Blog with title: <button class="btn btn-xs btn-info">' . $title . '</button> is successfully deleted <a href="/sliders">Continue</a><p>';
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

    $dbquery = mysqli_query($con,"SELECT * FROM blog INNER JOIN users ON blog.userid = users.user_id ORDER BY 'timestamp' DESC");
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
         <form action="editblog" method="post" role="form">
           <input type="hidden" name="blogid" value="'.$row['blogid'].'">
           <input type="hidden" name="blogtitle" value="'.$row['title'].'">
           <button class="btn btn-warning btn-xs"> <span class="glyphicon glyphicon-edit"> </span>  Edit blog </button>
         </form>
       </td>
       <td>
         <form action="" method="post" role="form">
           <input type="hidden" name="blogid" value="'.$row['blogid'].'">
           <input type="hidden" name="blogtitle" value="'.$row['title'].'">
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
