<?php
ob_clean();
require_once 'header.php'; 
echo '<h4 class="naslov" >Постови</h4>';
?>
<p class="naslov" >
  <?php



  $delete = $_POST['delete'];
  $productid = $_POST['productid'];
  $title = $_POST['producttitle'];
  if($delete === "delete") {
    $action = deleteproduct($productid);
    if($action === "success") {
      echo '<p class="center">product with title: <button class="btn btn-xs btn-info">' . $title . '</button> is successfully deleted <a href="/listproducts">Continue</a><p>';
    }
  }
  ?>
</p>

<table class="table tablesorter" id="producttable">
  <thead>
    <tr>
      <th>Title</th>
      <th>Date</th>
      <th>Tags</th>
      <th>Category</th>
      <th>Short URL</th>
      <th>User</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
    <?php 

    $dbquery = mysqli_query($con,"SELECT * FROM product INNER JOIN users ON product.userid = users.user_id ORDER BY product.id DESC");
    while($row = mysqli_fetch_array($dbquery)) {

      $keywords = $row['keywords'];
      $keywords = explode(",", $keywords);

      foreach ($keywords as $key => $value) {
        if($value != NULL) {
          $tags .= '<button class="btn btn-xs btn-info"> '.$value.' </button> &nbsp;';
        }
      }

      $date = date('d-M-Y H:i',strtotime($row['timestamp']));

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
        <td>'.$date.'</td>
        <td>'.$tags.'</td>
        <td>'.$category.'</td>
        <td>'.$url.'</td>
        <td>'.$row['user_name'].' '.$row['user_lastname'].'</td>
        <td>
         <form action="editproduct" method="post" role="form">
           <input type="hidden" name="productid" value="'.$row['id'].'">
           <input type="hidden" name="producttitle" value="'.$row['title'].'">
           <button class="btn btn-warning btn-xs"> <span class="glyphicon glyphicon-edit"> </span>  Edit post </button>
         </form>
       </td>
       <td>
         <form action="" method="post" role="form">
           <input type="hidden" name="productid" value="'.$row['id'].'">
           <input type="hidden" name="producttitle" value="'.$row['title'].'">
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
