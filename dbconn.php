<?php
$host = "sql12.freesqldatabase.com";  // Replace with actual host from dashboard
$user = "sql12788048";                // Your DB username
$pass = "5tcu679AWt";               // Your DB password
$db   = "sql12788048";                // Your DB name

$conn = new mysqli($host, $user, $pass, $db);

if($conn->connect_error){
    die("connection failed:\n".$conn->connect_error);
}
?>
