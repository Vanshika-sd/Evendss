<?php
include 'dbconn.php';
if (isset($_POST['final'])){
    $mail = $_POST['mail'];
}
$cal = "SELECT * FROM `calculation` where `Vendor` = '$mail' ";
$calresult = $conn->query($cal);    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="pr.css">
    <link rel="stylesheet" href="new.css">
</head>
<body>
<ul>
    <?php
    $total=0;
    if ($calresult->num_rows > 0) {
        while ($rw = $calresult->fetch_assoc()) {
          $name = $rw['Name'];
          $cost = $rw['Cost'];
          $total+= $cost;
    ?>
    <li class='fr'>
      <strong><h4 style='margin-left: 18px;'><?php echo $name; ?></h4></strong>
        <div class='form-floating' style='margin-right: 23px;'>
            <?php echo $cost; ?>
        </div>
    </li>    
    <?php 
    }
    ?>
    <li class='fr'>
     <strong><h4 style='margin-left: 18px;'>Total</h4></strong>
        <div class='form-floating' style='margin-right: 23px;'>
            <?php echo $total; ?>
        </div>
    </li>
    <?php 
    }
    ?> 
</ul>
</body>
</html>