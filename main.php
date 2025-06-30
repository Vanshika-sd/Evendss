<?php
session_start();
include 'dbconn.php';
if (isset($_GET['chat'])) {
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) { 
        header("Location: ch2.php");
        exit();
    } 
    else {
        // Show alert if not logged in
        echo"<script>alert('Kindly login to access chat.')</script>";
    }
}
if (isset($_GET['pr'])) {
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) { 
         header("Location: vendprof.php");
        exit();
    } 
    else {
        // Show alert if not logged in
        echo"<script>alert('Kindly login to access chat.')</script>";
    }
}
if (isset($_POST['lgin'])){
  $logemail = $_POST["name"];
  $logpass = $_POST["pass"];
  // check for the email if exists or not
  $existquery = "Select * from `user_details` where `Username`='$logemail' ";
  $existres = mysqli_query($conn, $existquery);
  $existsrows = mysqli_num_rows($existres);
  if($existsrows == 0){
    echo"<script>alert('This account does not exist please click on sign up to create account.')</script>";
  }
  else{
    // check for login 
    $query = "Select * from `user_details` where `Username`='$logemail' AND `Password`='$logpass' ";
    $res = mysqli_query($conn, $query);
    $num = mysqli_num_rows($res);
    if ($num==1) {
      echo"<script>alert('Success! You are loged in.')</script>";
      $_SESSION['loggedin'] = true;
      $_SESSION['Email'] = $logemail;
    }
    else{  
      echo"<script>alert('Incorrect Password')</script>";
    }
  }
}
if (isset($_POST['sign'])){
  // var declaration to store details
  $name = $_POST["name"];
  $email = $_POST["email"];
  $pass = $_POST["pass"];
  $cpass = $_POST["cpass"];
  // check for the email if exists or not
  $existquery = "Select * from `user_details` where `Email`='$email' ";
  $existres = mysqli_query($conn, $existquery);
  $existsrows = mysqli_num_rows($existres);
  if($existsrows > 0){
   echo"<script>alert(' This account already exists kindly login to access.')</script>";
  }
  else {
    if($cpass != $pass){
      echo"<script>alert('passwords do not match')</script>";
    }
    else{
      $sql = "INSERT INTO `user_details` (`Username`, `Email`, `Password`) VALUES ('$name', '$email', '$pass')";
      $result = mysqli_query($conn, $sql);
      if($result){
        echo"<script>alert('Success! Your account is now Created.')</script>";
        $_SESSION['loggedin'] = true;
        $_SESSION['Email'] = $name;
      }
    }
  }
}
if (isset($_POST['out'])){
    session_destroy();
    header("Location: main.php");
}
$results = [];
$search = "";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management Platform</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div style="height:75px" >
        <div class="navbr" id="h">
            <nav>
                <div class="opts">
                    <div>
                        <button class="nv" onclick="hello();">
                            <div id="enu">
                                <svg xmlns="http://www.w3.org/2000/svg" width="54" height="44" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <line x1="3" y1="12" x2="21" y2="12"></line>
                                    <line x1="3" y1="6" x2="21" y2="6"></line>
                                    <line x1="3" y1="18" x2="21" y2="18"></line>
                                </svg>
                            </div>
                            <div>Menu</div>
                        </button>
                    </div>
                    <div><img src="log1-removebg-preview.png" alt="logo" width="169" height="75"
                            style="margin-left: 95px;"></div>
                    <div class="sbar">
                        <div>
                            <?php
                            if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true) {
                            ?>
                            <button onclick='hello1()' class='bage ba'>Login</button>
                            <?php
                            }
                            else{ 
                            ?>
                            <form method="POST">
                                <button type='submit' name='out' class='bage ba'>Log Out</button>
                            </form>
                            <?php                           
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <div class="mnav" id="mna">
            <button class="close" onclick="bye();">
                <div id="icon"><img src="icons8-delete (1).svg" alt=""></div>
                <div>Close</div>
            </button>
            <div class="categ">
                <div class="subc"><a href="">Home</a></div>
                <div class="subc"><span onclick='hello1()'>My Account</span></div>
                <div class="subc"><a href="login.php">List Your Company</a></div>
                <div class="subc"><a href="recruit.php">Hire Staff</a></div>
                <div class="subc"><a href="joblogin.php">Apply for Job</a></div>
                <div class="subc"><a href="hc.html">Help Center</a></div>
            </div>
            <br>
            <hr>
            <div class="descript">
                <div class="sdes">Sustainability</div>
                <div class="sdes">India</div>
                <div class="sdes">1800 103 9988</div>
            </div>
        </div>
        <div class="smenu" id="smen">
            <div class="hd f">
                <h1>My Account</h1>
                <button onclick="bye1();" style="margin-right:57px;">
                    <div class="cl">
                        <img src="imagesx.png" alt="" height="25px" width="26px">
                    </div>
                </button>
            </div><br>
            <div class="login" style="text-align:center;">
                <div class="form-container" id="login-form">
                    <div class="hd">
                        <h2>Login</h2>
                        <p>I already have an account </p><br>
                    </div>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <!-- Username -->
                        <div class="form-floating">
                            <input type="text" name="name" class="form-control" id="floatingInput"
                                placeholder="" pattern="^[A-Za-z]+$" title="Only letters allowed" fdprocessedid="npc5" required
                                style="border-radius: 23px;" maxlength="10">
                            <label for="floatingInput">Username:</label>
                            <div style="padding: 9px;"></div>
                        </div>
                        <!-- Password -->
                        <div class="form-floating">
                            <input type="password" name="pass" class="form-control" id="floatingPassword"
                                placeholder="Password" fdprocessedid="zyc4p7" style="border-radius: 23px;" maxlength="8" required>
                            <label for="floatingPassword">Password</label>
                        </div>
                        <div style="padding: 9px;"></div>
                        <!-- Login Button -->
                        <button type="submit" class="btton" name="lgin">Login</button>
                        <!-- Sign up link -->
                    </form>
                    <p>Don't have an account? <span class="toggle"><button onclick="shsign()">Sign up</button> </span>
                    </p>
                </div>
                <div class="hiddn" id="signup-form">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <h2>Sign Up</h2>
                        <p>Create your account on Evendss</p>
                        <!-- Username -->
                        <div class="form-floating">
                            <input type="text" name="name" class="form-control" id="floatingInput" placeholder=""
                                fdprocessedid="npc5" pattern="^[A-Za-z]+$" maxlength="10" title="Only letters allowed" required>
                            <label for="floatingInput">Username</label><br>
                        </div>
                        <!-- email -->
                        <div class="form-floating">
                            <input type="email" class="form-control" name="email" id="floatingInput"
                                placeholder="name@example.com" pattern="^[^\s@]+@[^\s@]+\.[c]+[o]+[m]+$" title="Invalid email format" fdprocessedid="npc5" required minlength="12">
                            <label for="floatingInput">Email</label><br>
                        </div>
                        <!-- password -->
                        <div class="form-floating">
                            <input type="password" class="form-control" name="pass" id="floatingInput"
                                placeholder="name@example.com" fdprocessedid="npc5" required maxlength="8">
                            <label for="floatingInput">Password</label><br>
                        </div>
                        <!-- confirm password -->
                        <div class="form-floating">
                            <input type="password" class="form-control" name="cpass" id="floatingInput"
                                placeholder="name@example.com" fdprocessedid="npc5" required >
                            <label for="floatingInput">Confirm Password</label><br>
                        </div>
                        <!-- signup button -->
                        <button type="submit" class="btton" style="margin-top: 4px;" name="sign">Sign Up</button>
                        <!-- login link  -->
                        <p>Already have an account? <span class="toggle"><button onclick="log()">Login</button></span>
                        </p>
                    </form>
                </div>
            </div>
        </div>
        <br><br>
        <hr><br><br>
    </div>
    <!-- hero section -->
    <div class="wle" id="mv">
        <div class="herd">
            <div class="herdCon">
                <h1 class="hero-title">Find the Perfect Vendors for Every Occasion</h1>
                <p class="hero-subtitle">Effortlessly discover and book caterers, decorators, and more for your special
                    events.</p>
                <div class="services-section">
                    <div class="services-grid">
                        <div class="service-card imgid1">
                            <h3 class="service-title">Caterer</h3>
                            <p class="service-description">Find the best caterers for any occasion.</p>
                        </div>
                        <div class="service-card imgid2">
                            <h3 class="service-title">Decorater</h3>
                            <p class="service-description">Transform your event with expert decorators.</p>
                        </div>
                        <div class="service-card imgid3">
                            <h3 class="service-title">Photography</h3>
                            <p class="service-description">Capture memories with skilled photographers.</p>
                        </div>
                        <div class="service-card imgid5">
                            <h3>Event Planner</h3>
                            <p class="service-description">Find the best event and wedding planners for any
                                occasion.</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="payload">
            <div class="hero-cta">
                <form id="searchForm" role="search" method="POST" style="display: flex; width: 40%;align-items:center;justify-content:space-around;">
                    <button><img src="filter.svg" alt="" height="34px"></button>
                    <div style="display:flex; align-items: center;">
                        <div class="input-group mb-3" style="height:17px;">
                            <label class="input-group-text" for="inputGroupSelect01" class="btton">Vendors</label>
                            <select class="form-select" id="inputGroupSelect01" name="vend">
                                <option selected>Event Planner</option>
                                <option value="1">Wedding planner</option>
                                <option value="2">Caterer</option>
                                <option value="3">Decorator</option>
                            </select>
                        </div>
                    </div>
                    <div style="display:flex; align-items: center;">
                        <img src="images.png" height="24px" width="20px" alt="Search icon">
                        <input type="search" name="search" class="form-control" placeholder="  Search by location" aria-label="Search"
                            style="border-radius: 17px; border-width: 1px;" value="<?php echo htmlspecialchars($search); ?>">
                    </div>
                    <button type="submit" class="search-btn" name="sbtn">Search</button>
                </form>
            </div>
        <section class="unique-selling-points dbcon" id="resultsSection"> 
        <?php 
            $fetchquery = "Select * from `vendors_info`";
            $fetchres = mysqli_query($conn, $fetchquery);
            $numrows = mysqli_num_rows($fetchres);
            if($numrows>0){
            while($row = mysqli_fetch_array($fetchres)){?>
                <div class="vend">
                    <div class="disp" style="background-image:<?php $ig = $row['Image']; echo " url('images/$ig')";?>">
                        <h4 class="serv">
                            <?php echo $row['Service'] ?>
                        </h4>
                        <!-- <h2 style="color:white;font-weight:lighter;">Ratings:⭐⭐⭐⭐⭐(_ star)</h2> -->
                    </div>
                    <div class="info">
                        <h1 class="head">
                            <?php echo $row['Company_name'] ?>
                        </h1>
                        <div class="vch">
                            <div class="location"><img src="icons8-location.gif" alt="" height="20px">
                                <?php echo $row['State'] ?>,
                                <?php echo $row['District'] ?>
                            </div>
                            <!-- <form action="ch2.php" method="GET">
                                <input type="hidden" name="vendor_id" value="<?php echo $row['Email']; ?>">
                                <button type="submit" name="chat"><img src="chat (3).svg" height="34px"></button>
                            </form> -->
                        </div>
                        <div style="display:flex;width:400px;justify-content:center;">
                        <form action="vendprof.php" method="GET">
                            <input type="hidden" name="vendemail" value="<?php echo $row['Email']; ?>">
                            <button type="submit" name="pr"><h3 class="bage ba" style="width:170px;">Explore</h3></button>
                        </form>
                        <form action="ch2.php" method="GET">
                            <input type="hidden" name="vendor_id" value="<?php echo $row['Email']; ?>">
                            <button type="submit" name="chat"><h3 class="bage ba" style="width:170px;">Book now</h3></button>
                        </form>
                        </div>
                    </div>
                </div>
                <?php
            }}?>
        </section>
        </div>
        <!-- Footer Section -->

        <footer>
            <div class="foot">
                <div class="usp-container">
                    <div class="set">
                        <div class="usp-grid">
                            <div class="usp-card">
                                <div class="usp-icon">📊</div>
                                <h3 class="usp-title">Comprehensive Profiles</h3>
                                <p class="usp-description">View detailed vendor profiles with reviews, photos, and
                                    prices.
                                </p>
                            </div>
                            <div class="usp-card">
                                <div class="usp-icon">💬</div>
                                <h3 class="usp-title">Instant Communication</h3>
                                <p class="usp-description">Message vendors directly for quotes and inquiries.</p>
                            </div>
                            <div class="usp-card">
                                <div class="usp-icon">⭐</div>
                                <h3 class="usp-title">Customer Reviews</h3>
                                <p class="usp-description">Read real reviews to make informed decisions.</p>
                            </div>
                        </div>
                        <div class="log">
                            <div style="transform:translateX(-30px)"><img src="log1-removebg-preview.png" alt=""
                                    height="75px" width="180px"></div>
                            <div>
                                <img src="icons8-facebook-logo-40.png" alt=""><br><br>

                                <img src="icons8-instagram-50.png" alt=""><br><br>

                                <img src="icons8-twitter-bird-48.png" alt=""><br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footerrr">
                    <section id="how-it-works">
                        <h3>How It Works</h3>
                        <div class="steps">
                            <div class="stp" data-aos="zoom-in">
                                <h4>1. Search</h4>
                                <p>Find vendors based on location, category, and budget.</p>
                            </div>
                            <div class="stp" data-aos="zoom-in" data-aos-delay="100">
                                <h4>2. Book</h4>
                                <p>Choose the best vendor and confirm your booking.</p>
                            </div>
                            <div class="stp" data-aos="zoom-in" data-aos-delay="200">
                                <h4>3. Celebrate</h4>
                                <p>Enjoy your event while we handle the rest.</p>
                            </div>
                        </div>
                    </section>
                    <section class="cinfo">
                        <ul>
                            <li>
                                <h3>A Client Advisor is Available at <a class="sl">1800 103 9988</a>.
                                    You can also <a class="sl">email us</a>.</h3>
                            </li>
                            <li>
                                <h3>FAQ's</h3>
                            </li>
                        </ul>
                    </section>
                </div>
                <hr style="transform: translateY(30px);">
                <div class="footerrr lft">
                    <div class="hlast">
                        <div>
                            <img src="in.svg">
                            <a class="sl"> India</a>
                        </div>
                    </div>
                    <div><span class="laspan lsl">
                            © 2024 Event Planning Platform. All rights reserved.
                        </span>
                    </div>
                </div>
            </div>
        </footer>
</div>
</div>
<script>
    $(document).ready(function() {
        $('#searchForm').on('submit', function(e) {
            e.preventDefault();  // Prevent the default form submission
        
            var formData = $(this).serialize();  // Serialize the form data for AJAX
        
            $.ajax({
                url: 'mainphp.php',  // Replace with the PHP script that processes the search
                method: 'POST',
                data: formData,  // Send form data
                success: function(response) {
                    // Update the page with the new results
                    $('#resultsSection').html(response);
                },
                error: function() {
                    alert('Error processing your request.');
                }
            });
        });
    });
</script>
<script src="/docs/5.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
<script src="home.js"></script>
</body>

</html>