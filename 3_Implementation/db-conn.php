<?php
// db_connection.php

$con = mysqli_connect("localhost", "root", "password", "hms");
// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>