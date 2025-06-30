<?php
if (isset($_POST['ed'])) {
    $ed = $_POST['ed'];
    $ng = $_POST['ng'];
    $sr = $_POST['sr'];
    $un = $_POST['uname'];
    $vm = $_POST['vmail'];
    $sql = "INSERT INTO `bookings` (`Date`,`Guests`,`Username`,`Vmail`,`Extras`) VALUES ('$ed','$ng','$un','$vm','$sr')"
    $result = mysqli_query($conn, $sql);
    if($result){   
    }else{echo "error";}
}
?>