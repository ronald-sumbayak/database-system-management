<?php
$host     = "localhost";
$username = "root";
$password = "";
$database = "fpmbd";

$link     = mysqli_connect ($host, $username, $password, $database);
mysqli_select_db ($link, $database);
?>