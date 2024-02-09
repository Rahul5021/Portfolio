<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "rahul_portfolio";

$conn = mysqli_connect($server, $username, $password, $database);

if (!$conn) {
    echo "<script>console.log('not connected')</script>";
}
else{
    echo "<script>console.log('connected')</script>";
}