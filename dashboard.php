<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['login']!=true) {
 header("location:admin.php"); 
}
include 'dbconn.php';
$userquery = "Select * from `user_details`";
$uresult = mysqli_query($conn, $userquery);
$user = mysqli_num_rows($uresult);

$vendquery = "Select * from `vendors_info`";
$vresult = mysqli_query($conn, $vendquery);
$vendor = mysqli_num_rows($vresult);

$empquery = "Select * from `job_info`";
$eresult = mysqli_query($conn, $empquery);
$emp = mysqli_num_rows($eresult);

$jobquery = "Select * from `ṛecruit`";
$jresult = mysqli_query($conn, $jobquery);
$job = mysqli_num_rows($jresult);

$bookings = "SELECT * FROM `bookings` where `Response` = '1' ";
$bookings_query = "SELECT * FROM `bookings` ";
$bookings_result = $conn->query($bookings_query);
$bookings = $conn->query($bookings);
$br = mysqli_num_rows($bookings_result);
$bs = mysqli_num_rows($bookings);

$rq = "SELECT * FROM `rating` ";
$rs = mysqli_query($conn, $rq);
$total = mysqli_num_rows($rs); 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dash.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="search-bar">
            <input type="text" placeholder="Search...">
        </div>
        
    </header>

    <!-- Sidebar -->
    <nav class="sidebar">
        <div><img src="log1-removebg-preview.png" alt=""
        height="75px" width="180px"></div><br>
        <ul>
            <li onclick="dash();" class="ext" id="ds">Dashboard</li>
            <li onclick="user();" id="us">User Table</li>
            <li onclick="vend();" id="vd">Vendor Data</li>
            <li onclick="jobe();" id="j">Employer Details</li>
            <li onclick="empe();" id="ep">Employee Data</li>
        </ul>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Dashboard Overview -->
        <section class="overview">
            <div class="metrics">
                <div class="metric-card">Total Users: <?php echo $user ?></div>
                <div class="metric-card">Total Vendors: <?php echo $vendor ?></div>
                <div class="metric-card">Total Employers: <?php echo $job ?></div>
                <div class="metric-card">Total Employees: <?php echo $emp ?></div>
            </div>
        </section>
        <section class="charts hiddn" id="cht">
            <div class="chart">
                <h3>Booking:</h3>
                <div class="chart-box">
                    <div>Booking Reqests: <?php echo $bs; ?></div>
                    <div>Booking Accepted: <?php echo $br; ?></div>
                </div>
            </div>
            <div class="chart">
                <h3>Reviews:</h3>
                <div class="chart-box">                    
                    <div>Total Reviews: <?php echo $total; ?></div>
                </div>
            </div>
            <div class="chart-container">
                  <div class="bar-container">
                      <?php
                            $dec = "SELECT * FROM `vendors_info` where `Service` = 'Decorater' ";
                            $cat = "SELECT * FROM `vendors_info` where `Service` = 'caterer' ";
                            $ev = "SELECT * FROM `vendors_info` where `Service` = 'Event_Planner' OR `Service` = 'Wedding Planner'";
                            $drs = mysqli_query($conn, $dec);
                            $crs = mysqli_query($conn, $cat);
                            $ers = mysqli_query($conn, $ev);
                            $dt = mysqli_num_rows($drs); 
                            $ct = mysqli_num_rows($crs); 
                            $et = mysqli_num_rows($ers); 
                            $rdt = 0;
                            if ($dt>0) {                                
                                while($row = $drs->fetch_assoc()){
                                  $rdt += 1;
                                }
                            }
                            $rct = 0;
                            if ($ct>0) {                                
                                while($row = $crs->fetch_assoc()){
                                  $rct += 1;
                                }
                            }
                            $ret = 0;
                            if ($et>0) {                                
                                while($row = $ers->fetch_assoc()){
                                  $ret += 1;
                                }
                            }
                            $data = ["Decorator" => $rdt,
                                     "Caterer" => $rct,
                                     "Event Planner" => $ret
                            ];
                      
                      $max_value = max($data);
                    
                      foreach ($data as $product => $value) {
                          $height = ($value / $max_value) * 100; // Scale the height based on the max value
                          echo "<div class='bar' style='height: {$height}%;'>
                                  {$product} ({$value})
                                </div>";
                      }
                      ?>
                  </div>
                  <div class="x-axis"></div>
                  <div class="y-axis"></div>
            </div>
        </section>
        

        <!-- Tables -->
        <div class="hiddn" id="ta">
            <section class="tables">
                <div class="table">
                    <h3><?php echo "Vendor Table"; ?></h3>
                    <table>
                        <thead>
                            <tr>
                                <?php
                                $tname= "vendors_info";
                                $sql= "Select * from `$tname`";
                                $cq= "SHOW COLUMNS FROM `$tname`";
                                $result = mysqli_query($conn,$sql);
                                $reslt= mysqli_query($conn,$cq);
                                if ($reslt->num_rows > 0) {
                                    while($row = $reslt->fetch_assoc()){
                                        echo "<th style='padding:2px;'>".$row['Field']."</th>";
                                    }echo "<th style='padding:2px;'></th><th style='padding:2px;'></th>";
                                }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()){
                                ?>
                                <tr><td style='padding:2px;'><?php echo $row['S_no'] ?> </td>
                                    <td style='padding:4px;'><?php echo $row['Service'] ?> </td>
                                    <td><?php echo $row['Company_name'] ?> </td>
                                    <td style='padding:4px;'><?php echo $row['Phone_number'] ?> </td>
                                    <td style='padding:4px;'><?php echo $row['Email'] ?> </td>
                                    <td style='padding:4px;'><?php echo $row['Password'] ?> </td>
                                    <td><?php echo $row['State'] ?> </td>
                                    <td><?php echo $row['District'] ?> </td>
                                    <td><div class="imgs" style="background-image:<?php $ig = $row['Image']; echo "url('images/$ig')";?>"></td>
                                    <td><?php echo $row['About'] ?> </td>
                                    <td><?php echo $row['Date'] ?> </td>
                                    <td><form method='POST'>
                                        <input type="hidden" name="id" value="<?php echo $row['S_no']; ?>">
                                        <input type="hidden" name="serv" value="<?php echo $row['Service']; ?>">
                                        <input type="hidden" name="cn" value="<?php echo $row['Company_name']; ?>">
                                        <input type="hidden" name="pn" value="<?php echo $row['Phone_number']; ?>">
                                        <input type="hidden" name="em" value="<?php echo $row['Email']; ?>">
                                        <input type="hidden" name="pass" value="<?php echo $row['Password']; ?>">
                                        <input type="hidden" name="st" value="<?php echo $row['State']; ?>">
                                        <input type="hidden" name="dis" value="<?php echo $row['District']; ?>">
                                        <input type="hidden" name="img" value="<?php echo $row['Image']; ?>">
                                        <input type="hidden" name="abt" value="<?php echo $row['About']; ?>">
                                        <input type="hidden" name="dt" value="<?php echo $row['Date']; ?>">
                                         <button name="rev" type='submit'>Update</button>
                                        </form></td>                                   
                                    <td><form method='POST' action="del.php">
                                         <input type="hidden" name="mail" value="<?php echo $row['Email']; ?>">
                                         <input type="hidden" name="name" value="<?php echo $tname; ?>">
                                         <button type='submit'>Remove</button>
                                        </form></td></tr>
                                <?php
                                }
                                }
                                ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
        <div class="extr hiddn" id="tas">
            <section class="tables">
                <div class="table">                
                    <h3><?php echo "User Table"; ?></h3>
                    <table>
                        <thead>
                            <tr>
                                <?php
                                $tname= "user_details";
                                $sql= "Select * from `$tname`";
                                $cq= "SHOW COLUMNS FROM `$tname`";
                                $result = mysqli_query($conn,$sql);
                                $reslt= mysqli_query($conn,$cq);
                                if ($reslt->num_rows > 0) {
                                    while($row = $reslt->fetch_assoc()){
                                        echo "<th>".$row['Field']."</th>";
                                    }echo "<th></th><th></th>";
                                }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()){ 
                                ?>
                                    <tr><td><?php echo $row['Id'] ?></td>
                                    <td><?php echo $row['Username'] ?></td>
                                    <td><?php echo $row['Email'] ?></td>  
                                    <td><?php echo $row['Password'] ?></td>  
                                    <td><?php echo $row['Date'] ?></td>
                                    <td><form method='POST'>
                                        <input type="hidden" name="id" value="<?php echo $row['Id']; ?>">
                                        <input type="hidden" name="unm" value="<?php echo $row['Username']; ?>">
                                        <input type="hidden" name="em" value="<?php echo $row['Email']; ?>">
                                        <input type="hidden" name="pass" value="<?php echo $row['Password']; ?>">
                                        <input type="hidden" name="dt" value="<?php echo $row['Date']; ?>">
                                         <button name="reu" type='submit'>Update</button>
                                        </form></td>                                     
                                    <td><form method='POST' action="del.php">
                                         <input type="hidden" name="mail" value="<?php echo $row['Email']; ?>">
                                         <input type="hidden" name="name" value="<?php echo $tname; ?>">
                                         <button type='submit'>Remove</button>
                                        </form></td></tr>
                                <?php
                                }
                                }
                                ?>
                        </tbody>
                    </table>
                </div>    
            </section>
        </div>
        <div class="hiddn" id="tat">
            <section class="tables">
                <div class="table">                
                    <h3><?php echo "Employee Table"; ?></h3>
                    <table>
                        <thead>
                            <tr>
                                <?php
                                $tname= "job_info";
                                $sql= "Select * from `$tname`";
                                $cq= "SHOW COLUMNS FROM `$tname`";
                                $result = mysqli_query($conn,$sql);
                                $reslt= mysqli_query($conn,$cq);
                                if ($reslt->num_rows > 0) {
                                    while($row = $reslt->fetch_assoc()){
                                        echo "<th>".$row['Field']."</th>";
                                    }echo "<th></th><th></th>";
                                }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()){
                                ?>
                                <tr><td><?php echo $row['S_number'] ?></td>
                                    <td><?php echo $row['Name'] ?></td>
                                    <td><?php echo $row['Qualification'] ?></td>
                                    <td><?php echo $row['Email'] ?></td>
                                    <td><?php echo $row['Password'] ?></td>
                                    <td><?php echo $row['Work_exp'] ?></td>
                                    <td><?php echo $row['State'] ?></td>
                                    <td><?php echo $row['District'] ?></td>
                                    <td><?php echo $row['Self_desc'] ?></td>
                                    <td><?php echo $row['Skills'] ?></td>  
                                    <td><?php echo $row['Date'] ?></td>  
                                    <td><form method='POST'>
                                        <input type="hidden" name="id" value="<?php echo $row['S_number']; ?>">
                                        <input type="hidden" name="nm" value="<?php echo $row['Name']; ?>">
                                        <input type="hidden" name="qual" value="<?php echo $row['Qualification']; ?>">
                                        <input type="hidden" name="em" value="<?php echo $row['Email']; ?>">
                                        <input type="hidden" name="pass" value="<?php echo $row['Password']; ?>">
                                        <input type="hidden" name="work" value="<?php echo $row['Work_exp']; ?>">
                                        <input type="hidden" name="st" value="<?php echo $row['State']; ?>">
                                        <input type="hidden" name="dis" value="<?php echo $row['District']; ?>">
                                        <input type="hidden" name="abt" value="<?php echo $row['Self_desc']; ?>">
                                        <input type="hidden" name="skill" value="<?php echo $row['Skills']; ?>">
                                        <input type="hidden" name="dt" value="<?php echo $row['Date']; ?>">
                                         <button name="ree" type='submit'>Update</button>
                                        </form></td>                                  
                                    <td><form method='POST' action="del.php">
                                         <input type="hidden" name="mail" value="<?php echo $row['Email']; ?>">
                                         <input type="hidden" name="name" value="<?php echo $tname; ?>">
                                         <button type='submit'>Remove</button>
                                        </form></td></tr>
                                <?php
                                }
                                }
                                ?>
                        </tbody>
                    </table>
                </div>    
            </section>
        </div>
        <div class="extr hiddn" id="taf">
            <section class="tables">
                <div class="table">
                    <h3><?php echo "Employer Table"; ?></h3>
                    <table>
                        <thead>
                            <tr>
                                <?php
                                $tname= "ṛecruit";
                                $sql= "Select * from `$tname`";
                                $cq= "SHOW COLUMNS FROM `$tname`";
                                $result = mysqli_query($conn,$sql);
                                $reslt= mysqli_query($conn,$cq);
                                if ($reslt->num_rows > 0) {
                                    while($row = $reslt->fetch_assoc()){
                                        echo "<th>".$row['Field']."</th>";
                                    }echo "<th></th><th></th>";
                                }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()){
                                ?>
                                <tr><td><?php echo $row['Id'] ?></td>
                                    <td><?php echo $row['Job'] ?></td>
                                    <td><?php echo $row['Job_desc'] ?></td>
                                    <td><?php echo $row['Skills'] ?></td>
                                    <td><?php echo $row['Date'] ?></td>
                                    <td><?php echo $row['Location'] ?></td>                                    
                                    <td><?php echo $row['vmail'] ?></td>   
                                    <td><form method='POST'>
                                        <input type="hidden" name="id" value="<?php echo $row['Id']; ?>">
                                        <input type="hidden" name="jb" value="<?php echo $row['Job']; ?>">
                                        <input type="hidden" name="jbd" value="<?php echo $row['Job_desc']; ?>">
                                        <input type="hidden" name="skill" value="<?php echo $row['Skills']; ?>">
                                        <input type="hidden" name="dt" value="<?php echo $row['Date']; ?>">
                                        <input type="hidden" name="loc" value="<?php echo $row['Location']; ?>">
                                        <input type="hidden" name="em" value="<?php echo $row['vmail']; ?>">
                                         <button name="rej" type='submit'>Update</button>
                                        </form></td>                                                                   
                                    <td><form method='POST' action="del.php">
                                         <input type="hidden" name="mail" value="<?php echo $row['vmail']; ?>">
                                         <input type="hidden" name="name" value="<?php echo $tname; ?>">
                                         <button type='submit'>Remove</button>
                                        </form></td></tr>
                                <?php                              
                                }
                                }
                                ?>
                        </tbody>
                    </table>
                </div>    
            </section>
        </div>
        <div class="log footer">
                <img src="icons8-facebook-logo-40.png" alt="">
                <img src="icons8-instagram-100.png" alt="">
                <img src="icons8-twitter-bird-48.png" alt="">
                <img src="icons8-send-24.png" alt="" style="margin-right:0px">
        </div>
        <?php
        if (isset($_POST['rev'])) {
          $id=$_POST["id"];
          $serv = $_POST["serv"];
          $cn = $_POST["cn"];
          $pn = $_POST["pn"];
          $em = $_POST["em"];
          $pass = $_POST["pass"];
          $st = $_POST["st"];
          $dis = $_POST["dis"];
          $img = $_POST["img"];
          $abt = $_POST["abt"]; 
          $dt = $_POST["dt"]; 
        ?>
        <div id="bookingModal" class="modal">
            <!-- Booking Modal -->
            <div class="modal-content slide-in">
                <span class="close" onclick="closeBooking()">&times;</span>
                <h2></h2>
                <form method='POST' action="up.php">
                <input type="number" name="id" value="<?php echo $id; ?>"><br><br>
                <input type="text" pattern="^[A-Za-z\s]+$" title="Only letters allowed" name="serv" value="<?php echo $serv; ?>"><br><br>
                <input type="text" pattern="^[A-Za-z\s]+$" title="Only letters allowed" name="cn" value="<?php echo $cn; ?>"><br><br>
                <input type="number" minlength="10" maxlength="10" name="pn" value="<?php echo $pn; ?>"><br><br>
                <input type="email" pattern="^[^\s@]+@[^\s@]+\.[c]+[o]+[m]+$" title="Invalid email format" name="email" value="<?php echo $em; ?>"><br><br>
                <input type="password" maxlength="8" name="pass" value="<?php echo $pass; ?>"><br><br>
                <input type="text" pattern="^[A-Za-z]+$" title="Only letters allowed" name="st" value="<?php echo $st; ?>"><br><br>
                <input type="text" pattern="^[A-Za-z]+$" title="Only letters allowed" name="dis" value="<?php echo $dis; ?>"><br><br>
                <input type="text" name="img" value="<?php echo $img; ?>"><br><br>
                <input type="text" pattern="^[A-Za-z\s]+$" title="Only letters allowed" name="abt" value="<?php echo $abt; ?>"><br><br>
                <input type="date" name="dt" value="<?php echo $dt; ?>"><br><br>
                 <button name="rev" type='submit'>Update</button>
                </form>
            </div>
        </div>  
        <?php
        }if (isset($_POST['reu'])) {
            $id = $_POST["id"];
            $unm = $_POST["unm"];
            $em = $_POST["em"];
            $pass = $_POST["pass"];
            $dt = $_POST["dt"];
          ?>
          <div id="bookingModal" class="modal">
              <!-- Booking Modal -->
              <div class="modal-content slide-in">
                  <span class="close" onclick="closeBooking()">&times;</span>
                  <h2></h2>
                  <form method='POST' action="up.php">
                  <input type="number" name="id" value="<?php echo $id; ?>"><br><br>
                  <input type="text" pattern="^[A-Za-z]+$" title="Only letters allowed" name="unm" value="<?php echo $unm; ?>"><br><br>
                  <input type="email" pattern="^[^\s@]+@[^\s@]+\.[c]+[o]+[m]+$" title="Invalid email format" name="email" value="<?php echo $em; ?>"><br><br>
                  <input type="text" maxlength="8" name="pass" value="<?php echo $pass; ?>"><br><br>
                  <input type="date" name="dt" value="<?php echo $dt; ?>"><br><br>
                  <button name="reu" type='submit'>Update</button>
                  </form>
              </div>
          </div>  
          <?php
          }if (isset($_POST['ree'])) {
            $id=$_POST["id"];
            $nm = $_POST["nm"];
            $qual = $_POST["qual"];
            $em = $_POST["em"];
            $pass = $_POST["pass"];
            $work= $_POST["work"];
            $st = $_POST["st"];
            $dis = $_POST["dis"];
            $abt = $_POST["abt"]; 
            $skill = $_POST["skill"]; 
            $dt = $_POST["dt"];
          ?>
          <div id="bookingModal" class="modal">
              <!-- Booking Modal -->
              <div class="modal-content slide-in">
                  <span class="close" onclick="closeBooking()">&times;</span>
                  <h2></h2>
                  <form method='POST' action="up.php">
                  <input type="number" name="id" value="<?php echo $id; ?>"><br><br>
                  <input type="text" pattern="^[A-Za-z\s]+$" title="Only letters allowed" name="nm" value="<?php echo $nm; ?>"><br><br>
                  <input type="text" pattern="^[A-Za-z]+$" title="Only letters allowed" name="qual" value="<?php echo $qual; ?>"><br><br>
                  <input type="email" pattern="^[^\s@]+@[^\s@]+\.[c]+[o]+[m]+$" title="Invalid email format" name="email" value="<?php echo $em; ?>"><br><br>
                  <input type="password" maxlength="8" name="pass" value="<?php echo $pass; ?>"><br><br>
                  <input type="number" pattern="^[A-Za-z\s]+$" title="Only letters allowed" name="work" value="<?php echo $work; ?>"><br><br>
                  <input type="text" pattern="^[A-Za-z]+$" title="Only letters allowed" name="st" value="<?php echo $st; ?>"><br><br>
                  <input type="text" pattern="^[A-Za-z]+$" title="Only letters allowed" name="dis" value="<?php echo $dis; ?>"><br><br>
                  <input type="text" pattern="^[A-Za-z\s]+$" title="Only letters allowed" name="abt" value="<?php echo $abt; ?>"><br><br>
                  <input type="text" pattern="^[A-Za-z\s]+$" title="Only letters allowed" name="skill" value="<?php echo $skill; ?>"><br><br>
                  <input type="date" name="dt" value="<?php echo $dt; ?>"><br><br>
                   <button name="ree" type='submit'>Update</button>
                  </form>
              </div>
          </div>  
          <?php
          }if (isset($_POST['rej'])) {
            $id=$_POST["id"];
            $jb = $_POST["jb"];
            $jbd = $_POST["jbd"];
            $skill = $_POST["skill"];
            $dt = $_POST["dt"]; 
            $loc = $_POST["loc"];
            $em = $_POST["em"];
          ?>
          <div id="bookingModal" class="modal">
              <!-- Booking Modal -->
              <div class="modal-content slide-in">
                  <span class="close" onclick="closeBooking()">&times;</span>
                  <h2></h2>
                  <form method='POST' action="up.php">
                  <input type="hidden" name="id" value="<?php echo $id; ?>"><br><br>
                  <input type="text" pattern="^[A-Za-z]+$" title="Only letters allowed" name="jb" value="<?php echo $jb; ?>"><br><br>
                  <input type="text" pattern="^[A-Za-z\s]+$" title="Only letters allowed" name="jbd" value="<?php echo $jbd; ?>"><br><br>
                  <input type="text" pattern="^[A-Za-z\s]+$" title="Only letters allowed" name="skill" value="<?php echo $skill; ?>"><br><br>
                  <input type="date" name="dt" value="<?php echo $dt; ?>"><br><br>
                  <input type="text" pattern="^[A-Za-z]+$" title="Only letters allowed" name="loc" value="<?php echo $loc; ?>"><br><br>
                  <input type="email" name="email" value="<?php echo $em; ?>"><br><br>
                   <button name="rej" type='submit'>Update</button>
                  </form>
              </div>
          </div>  
          <?php
          }
          ?>  
    </main>
    <script src="dash.js"></script>
    <!-- <script>
        document.querySelectorAll("form").forEach(form=>{
            form.addEventListener("submit", function(event){
                event.preventDefault();
            });
        });
    </script> -->
</body>
</html>
