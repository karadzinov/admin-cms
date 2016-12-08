<?php
ob_clean();
require_once 'header.php'; 
echo '<h4 class="naslov" >Users</h4>';
?>

<p class="naslov" >
  <?php


// Process files
  $adduser = $_POST['adduser'];
  $edituser = $_POST['edituser'];
  $deleteuser = $_POST['deleteuser'];

  if (isset($adduser) && $adduser === "adduser") {
    extract($_POST);
    $action = adduser($user_name, $user_lastname, $user_email, $user_pass, $repeat_password, $is_user_admin);
    if ($action == "success") {
      echo '<p class="center">Username: <button class="btn btn-xs btn-info">' . $user_name . '</button> is successfully added to database <a href="/users">Continue</a><p>';
    } 
    else {
      echo '<p class="center">' . $action . '</p>';
    }
  }

  if (isset($edituser) && $edituser === "edituser") {
    extract($_POST);
    $action = edituser($user_id, $user_name, $user_lastname, $user_email, $user_pass, $repeat_password, $is_user_admin);
    if ($action == "success") {
      echo '<p class="center">Username: <button class="btn btn-xs btn-info">' . $user_name . '</button> is successfully edited <a href="/users">Continue</a><p>';
    } 
    else {
      echo '<p class="center">' . $action . '</p>';
    }
  }

  if (isset($deleteuser) && $deleteuser === "deleteuser") {
    extract($_POST);
    $action = deleteuser($user_id);
    if ($action === "success") {
      echo '<p class="center" id="continue">Username is successfully deleted <a href="/users">Continue</a><p>';
    }
    else {
      echo '<p class="center">' . $action . '</p>';
    }
  }



  echo LIST_USERS;



  ?>
</p>


<table class="table">
  <?php
  echo '<thead><th>' . NAME . '</th><th>' . LASTNAME . '</th><th>' . EMAIL . '</th><th>' . ISADMIN . '</th><th>' . EDIT . '</th></thead>'; ?>

  <?php
  $sql = mysqli_query($con, "SELECT * FROM users");
  echo '
  <tbody>     
    ';

    while ($row = mysqli_fetch_array($sql)) {

      $admin = $row['is_user_admin'];

      if ($admin == 1) {

        $administrator = '<button class="btn btn-danger btn-xs" type="button">Administrator</button>';
      } 
      else if ($admin == 0) {
        $administrator = '<button class="btn btn-info btn-xs" type="button">User</button>';
      } 
      else {
        $administrator = '<button class="btn btn-warning btn-xs" type="button">Moderator</button>';
      }

      echo '
      <form action="' . $_SERVER['PHP_SELF'] . '#edit" method="post">                 
        <tr>
          <td>' . $row['user_name'] . '</td>
          <td>' . $row['user_lastname'] . '</td>
          <td>' . $row['user_email'] . '</td>
          <td>' . $administrator . '</td>
          <td>
            <input type="hidden" name="user_id" value="' . $row['user_id'] . '" />
            <button class="btn btn-success btn-xs" type="submit">' . FORM_EDIT . '</button>
          </td>
        </tr>
      </form>
      ';
    }
    ?>
  </tbody>
</table>



<p class="naslov">
  <form action="#add" method="post">
    <input type="hidden" name="adduser" value="1" />
    <button type="subbmit" class="btn btn-info">
      <span class="glyphicon glyphicon-plus-sign"> </span> <?php
      echo ADD_USER; ?></button>
    </form>
  </p>

  <?php
  $user_id = $_POST['user_id'];






  if (isset($user_id) && $user_id != NULL) {
    $sql = mysqli_query($con, "SELECT * FROM users WHERE user_id = '$user_id'");
    while ($row = mysqli_fetch_array($sql)) {

      if ($row['is_user_admin'] == 0) {
        $rankeden = "selected";
      } 
      else if ($row['is_user_admin'] == 1) {
        $rankdva = "selected";
      } 
      else {
        $ranktri = "selected";
      }
      echo '
      <hr />
      <div class="row">
        <h3 id="edit">' . EDIT_FORM . '</h3>
        <div class="col-md-4">
          <form action="' . $_SERVER['PHP_SELF'] . '" method="post" role="form" class="form-horizontal">
            <input type="hidden" name="edituser" value="edituser" />
            
            <input type="hidden" class="form-control"  name="user_id" value="' . $row['user_id'] . '" id="inputusername" />

            <div class="form-group">
              <label for="inputusername">' . FIRST_NAME . '</label>
              <input type="text" class="form-control" name="user_name" value="' . $row['user_name'] . '" id="inputusername" />
            </div>

            <div class="form-group">
              <label for="inputlastname">' . LAST_NAME . '</label>
              <input type="text" class="form-control" name="user_lastname" value="' . $row['user_lastname'] . '" id="inputlastname" />
            </div>

            <div class="form-group">
              <label for="inputemail" >' . USER_EMAIL . '</label>
              <input type="text" class="form-control" name="user_email" value="' . $row['user_email'] . '" id="inputemail" />
            </div>
            <div class="form-group">
              <label for="inputrank">' . USER_RANK . '</label>
              <select name="is_user_admin" id="inputrank" class="form-control">
               <option value="0" ' . $rankeden . '>User</option>
               <option value="1" ' . $rankdva . '>Administrator</option>
               <option value="2" ' . $ranktri . '>Moderator</option>
             </select>
           </div>

           <div class="form-group">
            <label for="inputpassword">' . USER_PASS . '</label>
            <input type="password" class="form-control" name="user_pass" id="inputpassword" />
          </div>
          <div class="form-group">
            <label for="inputrepassword">' . RE_PASS . '</label>
            <input type="password"  class="form-control" name="repeat_password" id="inputrepassword"/>
          </div>
          <div class="form-group">
            <label for="submit"></label>
            <button type="submit" class="btn btn-default" id="submit">' . SUBMIT_FORM . '</button>
          </div>

        </form>
      </div>
      <div class="col-md-12">
        <p class="breadcrumb">' . IZBRISHI . '</p>

        <div class="form-group">
          <form action="' . $_SERVER['PHP_SELF'] . '" method="post">
            <input type="hidden" name="deleteuser" value="deleteuser" />
            <input type="hidden" value="' . $row['user_id'] . '" name="user_id"/>
            <label for="submit" class="col-sm-3 control-label">' . $row['user_name'] . ' ' . $row['user_lastname'] . '</label>
            <button class="btn btn-danger btn-xs" type="submit" id="submit">' . DELETE . '</button>
          </form>
        </div>
      </div>
    </div>
    ';
  }
} 
else if (isset($_POST['adduser']) && $_POST['adduser'] != NULL) {
  echo ' <hr />
  <div class="row">
    <h3 id="add">' . ADD_FORM . '</h3>
    <div class="col-md-4">
      <form action="' . $_SERVER['PHP_SELF'] . '" method="post" role="form" class="form-horizontal">
        <input type="hidden" name="adduser" value="adduser" />
        <div class="form-group">
          <label for="inputusername">' . FIRST_NAME . '</label>
          <input type="text" class="form-control" name="user_name" id="inputusername" />
        </div>

        <div class="form-group">
          <label for="inputlastname">' . LAST_NAME . '</label>
          <input type="text" class="form-control" name="user_lastname" id="inputlastname" />
        </div>

        <div class="form-group">
          <label for="inputemail">' . USER_EMAIL . '</label>
          <input type="text" class="form-control" name="user_email" id="inputemail" />
        </div>
        <div class="form-group">
          <label for="inputrank">' . USER_RANK . '</label>
          <select name="is_user_admin" id="inputrank" class="form-control">
           <option value="0">User</option>
           <option value="1">Administrator</option>
           <option value="2">Moderator</option>
         </select>
       </div>
       <div class="form-group">
        <label for="inputpassword">' . USER_PASS . '</label>
        <input type="password" class="form-control" name="user_pass" id="inputpassword" />
      </div>
      <div class="form-group">
        <label for="inputrepassword">' . RE_PASS . '</label>
        <input type="password" class="form-control" name="repeat_password" id="inputrepassword" />
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-default">' . SUBMIT_ADD_FORM . '</button>
      </div>
    </form>
  </div>
</div>';
}




require_once 'footer.php'; ?>
