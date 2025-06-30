<?php
include 'dbconn.php';
if (isset($_POST['vm'])) {
    $vm = $_POST['vm'];
    $cn = $_POST['cn'];
    $m = $_POST['m'];
    $sql="INSERT INTO `job` (`Name`, `Email`, `Vmail`) VALUES ('$cn', '$m', '$vm')";
    $result = mysqli_query($conn, $sql);
    header("location:jobprofile.php");
}
?>