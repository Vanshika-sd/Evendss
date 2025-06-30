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
  <div class="form-container" id="login-form">
      <h2>Welcome</h2>
        <p>Log in to your account.</p>
        <form action="" method="POST" enctype="multipart/form-data">
          <?php
          $login = false;
          $login_er = false;
          // if (isset($_POST['submit']))
          if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // including db connection to establish connection with database
            include 'dbconn.php';
            // login credentials
            $logemail = $_POST["email"];
            $logpass = $_POST["pass"];
            // check for the email if exists or not
            $existquery = "Select * from `admin` where `Email`='$logemail' ";
            $existres = mysqli_query($conn, $existquery);
            $existsrows = mysqli_num_rows($existres);
            if($existsrows == 0){
              $login_er="This account does not exist.";
            }
            else{
              // check for login 
              $query = "Select * from `admin` where `Email`='$logemail' AND `Password`='$logpass' ";
              $res = mysqli_query($conn, $query);
              $num = mysqli_num_rows($res);
              if ($num==1) {
                $login =true;
                session_start();
                $_SESSION['login'] = true;
                $_SESSION['Email'] = $logemail;
                header("location:dashboard.php");
              }
              else{
                $login_er="Incorrect Password";
              }
            }
          }
          ?>
          <?php
          if ($login) {
            echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong>You are loged in.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
            </div>';
          }
          ?>     
          <!-- Email -->
          <div class="form-floating">
            <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" fdprocessedid="npc5" required style="border-radius: 23px;">
            <label for="floatingInput">Email address</label>
            <div style="padding: 9px;"></div>
          </div>
          <!-- Password -->
          <div class="form-floating">
            <input type="password" name="pass" class="form-control" id="floatingPassword" placeholder="Password" fdprocessedid="zyc4p7" required style="border-radius: 23px;">
            <label for="floatingPassword">Password</label>
          </div>
          <?php
          if ($login_er) {
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>error!</strong>'.$login_er.'
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
          </div>';
          }
          ?> 
          <div style="padding: 9px;"></div>
          <!-- Login Button -->
          <button type="submit" class="btn">Login</button>
        </form>        
    </div>
  </div>

  <!-- <script src="script.js"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>
</html>