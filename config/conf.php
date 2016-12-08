<?php

// Create connection

$dbhost = "localhost";
$dbuser = "dns_db";
$dbpass = "owe04gus";
$dbname = "dns_db";

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die("Error connecting to database");
mysql_select_db($dbname);

$con = mysqli_connect("localhost", "dns_db", "owe04gus", "dns_db");
$con->set_charset('utf8');
require_once ("functions.php");
?>

