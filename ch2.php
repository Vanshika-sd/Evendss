<?php
session_start();
include 'dbconn.php';
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    echo "<script>alert('Kindly login to access chat');</script>";
    header("Location: main.php");
    exit();
}
if (isset($_GET['vendor_id'])) {
    $vendor_email = $_GET['vendor_id'];
    $query = "SELECT * FROM `vendors_info` WHERE `Email` = '$vendor_email' ";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $vendor = mysqli_fetch_assoc($result);
        $vendor_name = $vendor['Company_name'];
    } 
    else {
        echo "Vendor not found.";
        exit();
    }
} 
// Fetch logged-in user details
$username= $_SESSION['Email'];

if (isset($_POST['msgs'])){
    $sender = $username ;
    $receiver = $vendor_email;;
    $tm = $_POST["tm"];
    $sql = "INSERT INTO `chat_msg` (`Sender`, `Receiver`, `message`, `Date`) VALUES ('$sender', '$receiver', '$tm', current_timestamp())";
    $res = mysqli_query($conn, $sql);
}
if (isset($_POST['ed'])) {
    $ed = $_POST['ed'];
    $ng = $_POST['ng'];
    $sr = $_POST['sr'];
    $ev = $_POST['evnt'];
    $username = $_POST['uname'];
    $vendor_email = $_POST['vmail'];
    $sql = "INSERT INTO `bookings` (`Date`,`Event`,`Guests`,`Extras`,`Username`,`Vmail`) VALUES ('$ed','$ev','$ng','$sr','$username','$vendor_email')";
    $rst = mysqli_query($conn, $sql); 
    $query = "SELECT * FROM `vendors_info` WHERE `Email` = '$vendor_email' LIMIT 1";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $vendor = mysqli_fetch_assoc($result);
        $vendor_name = $vendor['Company_name'];
    } 
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
    <div class="chat" id="chat">
        <h2>Chat with Vendor:<?php echo $vendor_name; ?></h2>
        <div class="sendbox">
            <br>
            <div class="snd" > 
                <div id="chat-messages">
                    <?php
                    $display = "SELECT * FROM `chat_msg` WHERE `Sender` = '$username' AND `Receiver` = '$vendor_email' ";
                    $reslt = mysqli_query($conn, $display); 
                    $existsrows = mysqli_num_rows($reslt);
                    if($existsrows > 0){   
                        while($row = mysqli_fetch_array($reslt)){
                            echo "<div class='msg'>".$row['message']." </div>";
                        }
                    } 
                    ?>
                    <?php             
                    $prt = "SELECT * FROM `bookings` WHERE `Vmail` = '$vendor_email' AND `Username` ='$username' ";
                    $rlt = mysqli_query($conn, $prt);              
                    $show = mysqli_num_rows($rlt);
                    if($show > 0){   
                        while($row = mysqli_fetch_array($rlt)){
                            echo "<div class='msg'><div>Number Of Guests : ".$row['Guests']." </div>";
                            echo "<div> DATE : ".$row['Date']." </div>";
                            echo "<div>Location : ".$row['Extras']." </div>";
                            if($row['Response']==0){
                            echo  "<button class='bage'>Requested</button> </div>";
                            }else{
                            echo  "<button class='be'>Accepted</button> </div>";
                            }
                        }
                    }
                    ?>
                </div>
                <?php
                $reply = "SELECT * FROM `chat_msg` WHERE `Sender` = '$vendor_email' AND `Receiver` ='$username' ";
                $resllt = mysqli_query($conn, $reply); 
                $exrows = mysqli_num_rows($resllt);
                if($exrows > 0){   
                    while($row = mysqli_fetch_array($resllt)){
                        echo "<div class='msg receiv'>".$row['message']." </div>";
                    }
                }
                ?>
                
            </div>
            <br>
            <form method="POST" class="type" id="chat-form">
                <div class="form-floating" style="width: 85%;">
                    <input type="text" name="tm" id="message" class="form-control" id="floatingInput" placeholder=""
                        fdprocessedid="npc5" required>
                    <label for="floatingInput">Type a message</label>
                </div>
                <button type="submit" class="sendbtn bage ba" name="msgs"><img src="icons8-send-24.png" alt=""></button>
            </form>
        </div>
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
