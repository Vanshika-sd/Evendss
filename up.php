<?php 
session_start();
include 'dbconn.php';
if (isset($_POST['dn'])) {
    $id=$_POST["id"];
    $serv = $_POST["serv"];
    $cn = $_POST["cn"];
    $pn = $_POST["pn"];
    $em = $_POST["email"];
    $pass= $_POST["pass"];
    $st = $_POST["st"];
    $dis = $_POST["dis"];
    $img = $_POST["img"]; 
    $abt = $_POST["abt"]; 
    $dt = $_POST["dt"];
    $chg= "UPDATE `vendors_info` SET `S_no` = '$id', `Service` = '$serv', `Company_name` = '$cn', `Phone_number` = '$pn', `Email` = '$em', `Password` = '$pass', `State` = '$st', `District` = '$dis', `Image` = '$img', `About` = '$abt', `Date` = '$dt' WHERE `S_no` = '$id' ";
    $q=mysqli_query($conn,$chg);
    header("location: profile.php");
}
if (isset($_GET['ac'])) {
    $vend = $_GET['vmail'];
    $user = $_GET['uname'];
    $chg= "UPDATE `bookings` SET `Response` = '1' WHERE `Vmail` = '$vend' AND `Username` ='$user' ";
    $q=mysqli_query($conn,$chg);
    header("location: chat.php");
}
if (isset($_GET['vc'])) {
    $vend = $_GET['vmail'];
    $user = $_GET['uname'];
    $chg= "UPDATE `job` SET `Response` = '1' WHERE `Vmail` = '$vend' AND `Name` ='$user' ";
    $q=mysqli_query($conn,$chg);
    header("location: recruit.php");
}
if (isset($_POST['rev'])) {
    $id=$_POST["id"];
    $serv = $_POST["serv"];
    $cn = $_POST["cn"];
    $pn = $_POST["pn"];
    $em = $_POST["email"];
    $pass= $_POST["pass"];
    $st = $_POST["st"];
    $dis = $_POST["dis"];
    $img = $_POST["img"]; 
    $abt = $_POST["abt"]; 
    $dt = $_POST["dt"];
    $chg= "UPDATE `vendors_info` SET `S_no` = '$id', `Service` = '$serv', `Company_name` = '$cn', `Phone_number` = '$pn', `Email` = '$em', `Password` = '$pass', `State` = '$st', `District` = '$dis', `Image` = '$img', `About` = '$abt', `Date` = '$dt' WHERE `S_no` = '$id' ";
    $q=mysqli_query($conn,$chg);
    header("location: dashboard.php");
}
if (isset($_POST['reu'])) {
    $id = $_POST["id"];
    $unm = $_POST["unm"];
    $em = $_POST["email"];
    $pass = $_POST["pass"];
    $dt = $_POST["dt"]; 
    $chg= "UPDATE `user_details` SET `Id` = '$id', `Username` = '$unm', `Email` = '$em', `Password` = '$pass', `Date` = '$dt' WHERE `Id` = '$id' ";
    $q=mysqli_query($conn,$chg);
    header("location: dashboard.php");
}
if (isset($_POST['ree'])) {
    $id=$_POST["id"];
    $nm = $_POST["nm"];
    $qual = $_POST["qual"];
    $em = $_POST["email"];
    $pass = $_POST["pass"];
    $work= $_POST["work"];
    $st = $_POST["st"];
    $dis = $_POST["dis"];
    $abt = $_POST["abt"]; 
    $skill = $_POST["skill"]; 
    $dt = $_POST["dt"];
    $chg= "UPDATE `Job_info` SET `S_number` = '$id', `Name` = '$nm',`Qualification` = '$qual', `Email` = '$em', `Password` = '$pass', `Work_exp` = '$work', `State` = '$st', `District` = '$dis', `Self_desc` = '$abt',  `Skills` = '$skill', `Date` = '$dt'  WHERE `S_number` = '$id' ";
    $q=mysqli_query($conn,$chg);
    header("location: dashboard.php");    
}
if (isset($_POST['rej'])) {
    $id=$_POST["id"];
    $jb = $_POST["jb"];
    $jbd = $_POST["jbd"];
    $skill = $_POST["skill"];
    $dt = $_POST["dt"]; 
    $loc = $_POST["loc"];
    $em = $_POST["email"];
    $chg= "UPDATE `ṛecruit` SET `Job` = '$jb', `Job_desc` = '$jbd', `Skills` = '$skill', `Date` = '$dt', `Location` = '$loc', `vmail` = '$em' WHERE `Id` = '$id' ";
    $q=mysqli_query($conn,$chg);
    header("location: dashboard.php");
}
?>