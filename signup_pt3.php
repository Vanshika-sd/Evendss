<?php
include 'dbconn.php';
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true) {
 header("location:signup.php");
 exit(); 
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>LOGIN FORM</title>
  <link rel="stylesheet" href="logstyle.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body style="overflow: hidden;">
  <div class="logo"><img src="log1-removebg-preview.png" alt="logo" height="73px" width="184px"></div>    
  <div class="login-container"> 
    <div class="form-container sign" id="signup-form" style="padding: 25px;">
      <form class="sign" action="" method="POST" enctype="multipart/form-data">
        <?php
        $show_er = false;
        $show = false;
        // if (isset($_POST['submit']))
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          include 'dbconn.php';
          // var declaration to store details
          $email = $_SESSION['Email']; 
          $state = $_POST["state"];
          $district = $_POST["district"];
          // image uploading
          $file = $_FILES["img"]["name"];
          $tempname = $_FILES["img"]["tmp_name"];
          $folder = "images/".$file;
          move_uploaded_file($tempname,$folder);
          $about = $_POST["about"]; 
          // check for the email if exists or not
          $existquery = "Select * from `vendors_info` where `Email`='$email' ";
          $existres = mysqli_query($conn, $existquery);
          $existsrows = mysqli_num_rows($existres);
          if($existsrows > 0){
            $sql = "UPDATE `vendors_info` SET `State` = '$state' , `District` = '$district' , `Image` = '$file' , `About` = '$about'  WHERE `vendors_info`.`Email` = '$email' ";
            $result = mysqli_query($conn, $sql);
            if($result){
              $show = true;
              $login = true;
              session_start();
              $_SESSION['loggedin'] = true;
              $_SESSION['Email'] = $email;
              header("location:profile.php");
            }
          }
          else{
            header("location:signup.php");
          }
        }
        ?>
        <h2>Sign Up</h2>
        <p>Please register to list your organisation on evendss</p>
        <?php
        if ($show) {
          echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Success!</strong>Your account is now Created.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
          </div>';
        }
        ?>
        <?php
        if ($show_er) {
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>error!</strong>'.$show_er.'
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
          </div>';
        }
        ?>
        <!--location-->
        <div class="pho form-floating">
          <div class="form-floating">
            <input type="text" class="form-control" pattern="^[A-Za-z]+$" title="Only letters allowed" id="floatingInput" name="state" placeholder="" fdprocessedid="npc5" style="height: 34px;" required>
            <label for="floatingPassword">State</label><br>
          </div>
          <div class="form-floating">
            <input type="text" class="form-control" pattern="^[A-Za-z]+$" title="Only letters allowed" id="floatingInput" name="district" placeholder="" fdprocessedid="npc5" style="height: 34px;" required>
            <label for="floatingPassword">District</label><br>
          </div>
        </div>
        <!-- upload images -->
        <div class="form-floating">
          <input type="file" class="form-control" id="floatingInput" name="img" placeholder="" fdprocessedid="npc5" style="height: 34px;" required>
          <label for="floatingInput">Upload image</label>
        </div>
        <!-- description -->
        <div class="form-floating">
          <input type="text" class="form-control" pattern="^[A-Za-z/s]+$" title="Only letters and spaces allowed" id="floatingInput" name="about" placeholder="" fdprocessedid="npc5" style="height: 88px;" required>
          <label for="floatingInput">💬Give a short and crisp description of your work</label>
        </div>
        <!-- signup button -->
        <button type="submit" class="btn" style="margin-top: 4px;">Sign Up</button>
        <!-- login link  -->
        <p>Already have an account? <span class="toggle"><a href="login.php">Login</a></span></p>
      </form>
    </div>
  </div>

  <!-- <script src="script.js"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>
</html>