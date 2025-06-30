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
    <div class="form-container sign" id="signup-form" style="height:72vh;overflow-y: scroll;padding: 25px;">
      <form class="sign" action="" method="POST" enctype="multipart/form-data">
        <?php
        $show_er = false;
        $show = false;
        // if (isset($_POST['submit']))
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          include 'dbconn.php';
          // var declaration to store details
          $name = $_POST["name"];
          $edu = $_POST["edu"];
          $logemail = $_POST["email"];
          $pass = $_POST["pass"];
          $cpass = $_POST["cpass"];
          $exp = $_POST["exp"];
          $state = $_POST["state"];
          $district = $_POST["district"];
          $about = $_POST["about"]; 
          $skill = $_POST["skill"]; 
          // check for the email if exists or not
          $existquery = "Select * from `job_info` where `Email`='$email' ";
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
              $sql = "INSERT INTO `job_info` (`Name`, `Qualification`, `Email`, `Password`,`Work_exp`, `State`, `District`, `Self_desc`, `Skills`, `Date`) VALUES ('$name', '$edu', '$logemail', '$pass', '$exp', '$state', '$district', '$about', '$skill', current_timestamp())";
              $result = mysqli_query($conn, $sql);
              if($result){
                $show = true;
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['Email'] = $logemail;
                header("location:jobprofile.php");
              }
            }
          }
        }
        ?>
        <h2>Sign Up</h2>
       <p>Please sign in to creat a profile</p>
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
                
                <!-- Name -->
                <div class="form-floating">
                    <input type="text" class="form-control" name="name" pattern="^[A-Za-z\s]+$" title="Only letters and spaces allowed" id="floatingInput" placeholder="" fdprocessedid="npc5" required>
                    <label for="floatingInput">Full Name</label>
                </div>
                <!-- Qualifications -->
                <div class="form-floating">
                    <div>
                        <label for="floatingInput">Qualifications:</label>
                    </div>
                    <div>
                        <select class="form-control" name="edu" id="floatingInput" placeholder="" fdprocessedid="npc5" required>
                            <option value="Post Graduate">Post Graduate</option>
                            <option value="Gradute">Gradute</option>
                            <option value="Specialization/Diploma">Specialization/Diploma</option>
                            <option value="Matric Pass">Matric Pass</option>
                            <option value="none">None</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                </div>
                 <!-- email -->
                <div class="form-floating">
                    <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com"
                        fdprocessedid="npc5" pattern="^[^\s@]+@[^\s@]+\.[c]+[o]+[m]+$" title="Invalid email format" required>
                    <label for="floatingInput">Email address</label>
                </div>
                <!-- password -->
                <div class="form-floating">
                    <input type="password" name="pass" class="form-control" id="floatingInput" placeholder=""
                        fdprocessedid="npc5" required maxlength="8">
                    <label for="floatingInput">Password</label>
                </div>
                <!-- confirm password -->
                <div class="form-floating">
                    <input type="password" name="cpass" class="form-control" id="floatingInput" placeholder=""
                        fdprocessedid="npc5" required maxlength="8">
                    <label for="floatingInput">Confirm Password</label>
                </div>
                <!--work experience-->
                <div class="form-floating">
                    <div>
                        <label for="floatingInput">Work experience:</label>
                    </div>
                    <div>
                        <select class="form-control" name="exp" id="floatingInput" placeholder="" fdprocessedid="npc5" required>
                            <option value="less than 1 year">less than 1 year</option>
                            <option value="1 year">1 year</option>
                            <option value="2 years">2 years</option>
                            <option value="3 years">3 years</option>
                            <option value="more than 3 years">more than 3 years</option>
                            <option value="None">None</option>
                        </select>
                    </div>
                </div>
                <!--location-->
                <div class="pho form-floating">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="state" pattern="^[A-Za-z]+$" title="Only letters allowed" id="floatingInput" placeholder="" fdprocessedid="npc5"
                            style="height: 34px;" required>
                        <label for="floatingPassword">State</label><br>
                    </div>
                    <div class="form-floating">
                        <input type="text" class="form-control" name="district" pattern="^[A-Za-z]+$" title="Only letters allowed" id="floatingInput" placeholder="" fdprocessedid="npc5"
                            style="height: 34px;" required>
                        <label for="floatingPassword">District</label><br>
                    </div>
                </div>
                <!-- description -->
                <div class="form-floating">
                    <input type="text" class="form-control" name="about" pattern="^[A-Za-z\s]+$" title="Only letters and spaces allowed" id="floatingInput" placeholder="" fdprocessedid="npc5"
                        style="height: 88px;" required>
                    <label for="floatingInput">💬Write down about yourself or your work:</label>
                </div>
                <!-- Skills -->
                <div>
                    <label for="" id="floatingInput" placeholder="" fdprocessedid="npc5" name="skill">Skills:</label>
                    <div style="display:flex; justify-content: space-around;flex-wrap: wrap;" name="skill">
                        <label>Management
                            <input value="Management" type="checkbox">
                        </label>
                        <label>Leadership
                            <input value="Leadership" type="checkbox">
                        </label>
                        <label>photography
                            <input value="photography" type="checkbox">
                        </label>
                        <label>Cooking
                            <input value="Cooking" type="checkbox">
                        </label>
                        <label>Decoration
                            <input value="Decoration" type="checkbox">
                        </label>
                        <label>Hosting
                            <input value="Hosting" type="checkbox">
                        </label>
                        <label>Cleaning
                            <input value="Cleaning" type="checkbox">
                        </label>
                        <label>Hospitality
                            <input value="Hospitality" type="checkbox">
                        </label>
                        <label>Choreography
                            <input value="Choreography" type="checkbox">
                        </label>
                        <label>Music and Dj
                            <input value="Music and Dj" type="checkbox">
                        </label>
                    </div>
                </div>
                <!-- signup button -->
                <button type="submit" class="btn" style="margin-top: 4px;">Sign Up</button>
                <!-- login link  -->
                <p>Already have an account? <span class="toggle"><a href="joblogin.html">Login</a></span></p>
            </form>
        </div>
    </div>

    <!-- <script src="script.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>