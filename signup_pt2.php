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
  <title>REGISTRATION FORM</title>
  <link rel="stylesheet" href="logstyle.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body style="overflow: hidden;">
  <div class="logo"><img src="log1-removebg-preview.png" alt="logo" height="73px" width="184px"></div>    
  <div class="login-container"> 
    <div class="form-container" id="signup-form" style="padding: 25px;">
      <form class="sign" action="" method="POST" enctype="multipart/form-data">
        <?php
        $show_er = false;
        // if (isset($_POST['submit']))
        if ($_SERVER["REQUEST_METHOD"] == "POST") {          
          // var declaration to store details
          $email = $_SESSION['Email']; 
          $service = $_POST["service"];
          $cname = $_POST["cname"];
          $phone = $_POST["phone"];
          // check for the email if exists or not
          $existquery = "Select * from `vendors_info` where `Email`='$email' ";
          $existres = mysqli_query($conn, $existquery);
          $existsrows = mysqli_num_rows($existres);
          if($existsrows > 0){
            if(strlen($phone)!=10){
              $show_er = "invalid Phone number";
            }
            else{
              $sql = "UPDATE `vendors_info` SET `Service` = '$service' , `Company_name` = '$cname' , `Phone_number` = '$phone' WHERE `vendors_info`.`Email` = '$email' ";
              $result = mysqli_query($conn, $sql);
              if($result){
                $login = true;
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['Email'] = $email;
                header("location:signup_pt3.php");
              }
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
        if ($show_er) {
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>error!</strong>'.$show_er.'
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
          </div>';
        }
        ?>
        <!-- vendorship -->
        <div style="height: 27px;">
          <label for="floatingInput">You Serve As A:</label>
        </div>
        <div>
          <select class="form-control" id="floatingInput" name="service" placeholder="" fdprocessedid="npc5"required>
            <option value="Caterer">caterer</option>
            <option value="Decorater">decorater</option>
            <option value="Event_Planner">event planner</option>
            <option value="Wedding_Planner">wedding planner</option>
          </select>
        </div>
        <!-- business name -->
        <div class="form-floating">
          <input type="text" name="cname" pattern="^[A-Za-z/s]+$" title="Only letters and spaces allowed" class="form-control" id="floatingInput" placeholder="" fdprocessedid="npc5" required>
          <label for="floatingInput">Company's Name</label>
        </div>
        <!-- phone no. -->
        <div class="pho form-floating">
          <div class="code">
            <select class="form-control" id="floatingInput" placeholder="" fdprocessedid="npc5" style="height: 57px;" required>
              <option value="code">+91</option>
            </select>
          </div>
          <div class="form-floating">
            <input type="tel" class="form-control" id="floatingPassword" name="phone" placeholder="phone" fdprocessedid="zyc4p7" required style="width: 360px;" minlength="10" maxlength="10" required>
            <label for="floatingPassword">Phone Number</label><br>
            </div>
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