<?php
$server = "localhost";
$username = "root";
$password = "";
$dbname = "event";
$conn = mysqli_connect($server, $username, $password, $dbname);
if($conn->connect_error){
    die("connection failed:\n".$conn->connect_error);
}
?>