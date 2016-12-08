<?php require_once 'header.php'; ?>
<?php

session_start();
if (isset($_SESSION['user_email'])) {



	echo '





	<div class="col-md-4"><a href="/users"><span class="glyphicon glyphicon-user"> </span> Users</a></div>
	<div class="col-md-4"><a href="/settings"><span class="glyphicon glyphicon-cog"> </span> Settings</a></div>
	<div class="col-md-4"><a href="/sliders"><span class="glyphicon glyphicon-picture"> </span> Sliders</a></div>
	<div class="col-md-4"><a href="/banners"><span class="glyphicon glyphicon-paperclip"> </span> Banners</a></div>
	<div class="col-md-4"><a href="/addpage"><span class="glyphicon glyphicon-unchecked"> </span> Add Page</a></div>
	<div class="col-md-4"><a href="/listpages"><span class="glyphicon glyphicon-list-alt"> </span> List Pages</a></div>
	<div class="col-md-4"><a href="/addblog"><span class="glyphicon glyphicon-edit"> </span> Add Blog</a></div>
	<div class="col-md-4"><a href="/listblogs"><span class="glyphicon glyphicon-th-list"> </span> List Blogs</a></div>
	<div class="col-md-4"><a href="/categories"><span class="glyphicon glyphicon-object-align-bottom"> </span> Categories</a></div>
	<div class="col-md-4"><a href="/addproduct"><span class="glyphicon glyphicon-modal-window"> </span> Додади пост </a></div>
	<div class="col-md-4"><a href="/listproducts"><span class="glyphicon glyphicon-th"> </span> Види постови</a></div>

	




	';
} else {
	echo 'Please <a href="index.php">Log in</a>';
}
?>





<?php require_once 'footer.php'; ?>



