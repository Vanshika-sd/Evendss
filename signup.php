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
          include 'dbconn.php';
          // var declaration to store details
          $email = $_POST["email"];
          $pass = $_POST["pass"];
          $cpass = $_POST["cpass"];
          // check for the email if exists or not
          $existquery = "Select * from `vendors_info` where `Email`='$email' ";
          $existres = mysqli_query($conn, $existquery);
          $existsrows = mysqli_num_rows($existres);
          if($existsrows > 0){
            $show_er =" This account already exists kindly login to access.";
          }
          else {
            if($cpass != $pass){
              $show_er ="passwords do not match";
            }
            else{
              $sql = "INSERT INTO `vendors_info` (`Email`, `Password`) VALUES ('$email', '$pass')";
              $result = mysqli_query($conn, $sql);
              if($result){
                $login = true;
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['Email'] = $email;
                header("location:signup_pt2.php");
              }
            }
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
        <!-- email -->
        <div class="form-floating">
          <input type="email" pattern="^[^\s@]+@[^\s@]+\.[c]+[o]+[m]+$" title="Invalid email format" class="form-control" name="email" id="floatingInput" placeholder="name@example.com" fdprocessedid="npc5" required>
          <label for="floatingInput">Email</label>
        </div>
        <!-- password -->
        <div class="form-floating">
          <input type="password" class="form-control" name="pass" id="floatingInput" placeholder="name@example.com" fdprocessedid="npc5" maxlength="8" required>
          <label for="floatingInput">Password</label>
        </div>
        <!-- confirm password -->
        <div class="form-floating">
          <input type="password" class="form-control" name="cpass" id="floatingInput" placeholder="name@example.com" fdprocessedid="npc5" maxlength="8" required>
          <label for="floatingInput">Confirm Password</label>
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