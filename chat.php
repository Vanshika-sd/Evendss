<?php 
session_start();
include 'dbconn.php';
if (isset($_GET['uid'])) {
    $user = $_GET['uid'];
}
if (isset($_GET['vid'])) {
    $vend = $_GET['vid'];
}  
if (isset($_GET['ac'])) {
    $chg= "UPDATE `bookings` SET `Response` = '1' WHERE `Vmail` = '$vend' AND `Username` ='$user' ";
    $q=mysqli_query($conn,$chg);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tm = $_POST["tm"];
    $sql = "INSERT INTO `chat_msg` (`Sender`, `Receiver`, `message`, `Date`) VALUES ('$vend', '$user', '$tm', current_timestamp())";
    $res = mysqli_query($conn, $sql);
}
?> 
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link rel="stylesheet" href="chat.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
</head>

<body>
<div class="chat" id="chat">
        <h2>Chat with:<?php echo $user; ?></h2>
        <div class="sendbox">
            <br>
            <div class="snd" > 
                <?php
                $reply = "SELECT * FROM `chat_msg` WHERE `Sender` = '$user' ";
                $resllt = mysqli_query($conn, $reply); 
                $exrows = mysqli_num_rows($resllt);
                if($exrows > 0){   
                    while($row = mysqli_fetch_array($resllt)){
                        echo "<div class='msg receiv'>".$row['message']." </div>";
                    }
                }
                ?>
                <?php             
                    $prt = "SELECT * FROM `bookings` WHERE `Vmail` = '$vend' AND `Username` ='$user' ";
                    $rlt = mysqli_query($conn, $prt);              
                    $show = mysqli_num_rows($rlt);
                    if($show > 0){   
                        while($row = mysqli_fetch_array($rlt)){
                            echo "<div class='msg'><div>Number Of Guests : ".$row['Guests']." </div>";
                            echo "<div> DATE : ".$row['Date']." </div>";
                            echo "<div>Event : ".$row['Event']." </div>";               
                            echo "<div>Requests : ".$row['Extras']." </div>";               
                            if($row['Response']==1){
                                echo  "<button class='be'>Accepted</button> </div>";
                            }else{
                                echo "<form method='GET' action='up.php'><input type='hidden' name='uname' value='".$user."'>
                                      <input type='hidden' name='vmail' value='". $vend ."'>
                                     <button type='submit' class='bage ba' name='ac'>Accept</button></form></div>";
                            }
                        }
                    }
                ?>
                 <div id="chat-messages">
                    <?php
                    $display = "SELECT * FROM `chat_msg` WHERE `Sender` = '$vend' ";
                    $reslt = mysqli_query($conn, $display); 
                    $existsrows = mysqli_num_rows($reslt);
                    if($existsrows > 0){   
                        while($row = mysqli_fetch_array($reslt)){
                            echo "<div class='msg'>".$row['message']." </div>";
                        }
                    } 
                    ?>
                </div>
            </div>
            <br>
            <form method="POST" class="type" id="chat-form" enctype="multipart/form-data">
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
</body>

</html>