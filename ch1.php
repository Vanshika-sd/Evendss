<?php
session_start();
include 'dbconn.php';
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true) {
 header("location:login.php");
}
// Fetch logged-in user details
$vmail= $_SESSION['Email'];

if (isset($_POST['msgs'])){
    $sender = $username ;
    $receiver = $vendor_email;;
    $tm = $_POST["tm"];
    $sql = "INSERT INTO `chat_msg` (`Sender`, `Receiver`, `message`, `Date`) VALUES ('$sender', '$receiver', '$tm', current_timestamp())";
    $res = mysqli_query($conn, $sql);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Chat with Vendor</title>
    <link rel="stylesheet" href="chat.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body> 
    <div class="use">
    <div class="search">
        <form role="search" style="display: flex;align-items: center;">
            <img src="images.png" height="24px" width="20px" alt="Search icon">
            <input type="search" class="form-control insearch" placeholder="Search Users"
                aria-label="Search">
        </form>
    </div>
    <?php
    $disp = "SELECT DISTINCT `Sender` FROM `chat_msg` WHERE `receiver` = '$vmail'";
    $result= mysqli_query($conn,$disp);
    $fr = mysqli_num_rows($result);
    if($fr>0){
        while($row = mysqli_fetch_array($result) ){ ?>
            <form action="chat.php" method="GET" >
                <input type="hidden" name="uid" value="<?php echo $row['Sender']; ?>">
                <input type="hidden" name="vid" value="<?php echo $vmail; ?>">
                <button style="width:100%;" type="submit" > <div class='users'><img src='profile.svg' height='50px'><h2><?php echo $row['Sender']; ?></h2></div></button>
            </form>
    <?php
        }
    }
    ?>
    </div>
    <script src="/docs/5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <!-- <script src="scripts.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
