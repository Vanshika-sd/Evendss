<?php
include 'dbconn.php';
if (isset($_POST['remove'])){
    $nm = $_POST['date'];
    $gst = $_POST['guests'];
    $del = "DELETE FROM `calculation` WHERE `Name` = '$nm' AND `Cost` = '$gst' ";
    $dresult = mysqli_query($conn, $del);
    if ($dresult) {
        header("location:profile.php");
    }
}
if (isset($_POST['book'])){
    $ev = $_POST['evnt'];
    $ed = $_POST['date'];
    $gst = $_POST['guests'];
    $vendor_email = $_POST['mail'];
    $sql = "INSERT INTO `bookings` (`Date`,`Event`,`Guests`,`Vmail`) VALUES ('$ed','$ev','$gst','$vendor_email')";
    $rst = mysqli_query($conn, $sql); 
    header("location:profile.php");
}
if (isset($_POST['cal'])){
    $nm = $_POST['date'];
    $gst = $_POST['guests'];
    $vendor_email = $_POST['mail'];
    $sql = "INSERT INTO `calculation` (`Vendor`,`Name`,`Cost`) VALUES ('$vendor_email','$nm','$gst')";
    $rst = mysqli_query($conn, $sql); 
    header("location:profile.php");
}
if (isset($_POST['mail'])){
    $email = $_POST['mail'];
    $tn = $_POST['name'];
    $del = "DELETE FROM `$tn` WHERE `Email` = '$email' ";
    $dresult = mysqli_query($conn, $del);
    if ($dresult) {
        header("location:dashboard.php");
    }
}
?>