<?php

// Setup connection
$con = mysqli_connect("localhost", "dns_db", "owe04gus", "dns_db");
$con->set_charset('utf8');
// Check connection
if (mysqli_connect_errno($con)) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>