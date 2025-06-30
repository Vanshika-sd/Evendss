<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true) {
 header("location:login.php"); 
}
include 'dbconn.php';
$mail = $_SESSION['Email']; 

// Fetch bookings data
$bookings_query = "SELECT * FROM `bookings` where `Vmail` = '$mail' AND (`Response` = '1' OR `Username` = '') ";
$bookings_result = $conn->query($bookings_query);
$cal = "SELECT * FROM `calculation` where `Vendor` = '$mail' ";
$calresult = $conn->query($cal);
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="pr.css">
</head>

<body>
  <div class="whole" id="wh">
    <div class="hd">
      <section>
        <h1>Hello, 
          <?php 
          $fetchquery = "Select * from `vendors_info` where `Email`='$mail' ";
          $fetchres = mysqli_query($conn, $fetchquery);
          $row = mysqli_fetch_array($fetchres);
          $cn = $row['Company_name'];
          echo $cn;
          ?>
        </h1>
        <div style="display: flex;align-items: center;font-size: larger;margin-top: 10px;">
          <h4 class="text">Explore Recruitment >></h4>
          <form method="GET" action="recruit.php">
            <input type="hidden" name="vmail" value="<?php echo $mail; ?>">
            <button type="submit"><h5 style="font-weight: lighter;">Hire Employess for your company</h5></button>
          </form>
        </div>
      </section>
      <section style="margin-top: 6px;margin-right: 2px;display: flex;"><a href="ch1.php"><img src="chat (4).svg" alt="" height="60px"></a>
        <div class="notify"></div>
      </section>
    </div>
    <div class="imgs" style="background-image:<?php $ig = $row['Image']; echo "url('images/$ig')";?>"></div>
    <br>
    <div class="forb">
      <h3> <span class="bage ba"><a href="#br">Booking Requests</a></span></h3>
      <h3> <span class="bage ba"><a href="#rr">Rating and Reviews</a></span></h3>
      <h3> <span class="bage ba"><a href="#cc">Calculate Budget</a></span></h3>
      <h3> <span class="bage ba"><a href="#ar">Analytics</a></span></h3>
      <h3> <span class="bage ba" onclick="showep()">Edit Profile</span></h3>
    </div>

    <div class="brr cm" id="br">
      <div class="cont">
        <header class="header">
          <h1>Booking Management</h1>
        </header>
        <main class="main-content">
          <section class="booking-list">
            <h2>Upcoming Bookings</h2>
            <ul id="bookingList">
              <?php
              if ($bookings_result->num_rows > 0) {
                while ($rw = $bookings_result->fetch_assoc()) {
                  $evnt = $rw['Event'];
                  $dt = $rw['Date'];
                  $gst = $rw['Guests'];
                  echo "<li><strong>Event: </strong>$evnt  Date: $dt  Guests: $gst</li>";
                }
              }
              ?>
            </ul>
          </section>
          <section class="actions">
            <button id="addBookingBtn" class="btn" onclick="openBooking()">Add New Booking</button>
          </section>
        </main>
        <div id="bookingModal" class="modal">
          <div class="modal-content">
            <span id="closeModal" class="close-btn" onclick="closeBooking()">&times;</span>
            <h2>Add New Booking</h2>
            <form id="bookingForm" method="POST" action="del.php">
                <label for="floatingInput">Event:</label>
                <select class="form-control" id="floatingInput" name="evnt" placeholder="" fdprocessedid="npc5"required>
                  <option value="Bd">Birthday</option>
                  <option value="Eng">Engagement</option>
                  <option value="Event">Corporate Event</option>
                  <option value="Wedding">Wedding</option>
                  <option value="Bsh">Baby Shower</option>
                  <option value="oth">Other</option>
                </select>

              <label for="date">Date:</label>
              <input type="date" id="date" name="date" required>

              <label for="guests">Number of Guests:</label>
              <input type="number" id="guests" name="guests" required>

              <input type="hidden" name="mail" value="<?php echo $mail; ?>">
              <button type="submit" class="btn" name="book">Save Booking</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="rrr cm" id="rr">
      <div class="cont">
        <header class="header">
          <h1>Reviews and Ratings Analytics</h1>
        </header>
        <main>
          <section class="stats">
            <div class="stcard" id="avgRating">
              <h2>Average Rating</h2>
              <p class="value">
                <?php  
                $rq = "SELECT * FROM `rating` where `Vendor` = '$mail' ";
                $rs = mysqli_query($conn, $rq);
                $total = mysqli_num_rows($rs); 
                if ($total>0) { 
                  $rt = 0;
                  while($rw = $rs->fetch_assoc()){
                    $rat = $rw['Ratings'];
                    $rt += $rat;
                    $user = $rw['User'];
                    $rev = $rw['Review'];                    
                    $rat = $rw['Ratings'];
                  }
                  $tr = $rt/$total;
                  echo $tr;
                }
                ?>
              </p>
            </div>
            <div class="stcard" id="totalReviews">
              <h2>Total Reviews</h2>
              <p class="value"><?php echo $total; ?></p>
            </div>
          </section>
          <section class="chart-section">
            <section class="reviews">
              <h2>Recent Reviews</h2>
              <ul id="reviewList">
                ⭐⭐⭐⭐⭐
                <?php
                if ($total>0) {
                   echo "<li><strong>$user </strong>: $rev (Rating: $rat Stars)</li>";
                  }
                ?>
              </ul>
            </section>
          </section>
        </main>
      </div>
    </div>

    <div class="ccc cm" id="cc">
      <div class="cont">
        <div class="head">
          <h1>COST CALCULATION </h1>
        </div>
        <div class="items">
        <form>
          <ul class="cc">
            <?php
              if ($calresult->num_rows > 0) {
                while ($rw = $calresult->fetch_assoc()) {
                  $name = $rw['Name'];
                  $cost = $rw['Cost'];
                  echo "<form method='POST' action='del.php'>
                  <li class='fr'>
                  <div class='alert alert-warning alert-dismissible fade show' role='alert' style='display: flex;justify-content: space-evenly;'><strong><h4 style='width: 189px;'> $name </h4></strong>
                    <div class='form-floating' style='width: 374px;'>
                      <input type='hidden' name='date' value='$name'>
                      <input type='number' class='form-control' id='floatingInput' placeholder='' name='guests' fdprocessedid='npc5' value='$cost'>
                      <label for='floatingInput'>enter cost here</label>
                    </div>
                    <button type='submit' class='btn-close' data-bs-dismiss='alert' aria-label='Close' name='remove'></button>
                  </div>
                </li>
                </form>";
                }
              }
              ?>
          </ul>
        </form>
        </div>
        <div class="forc">
          <h1> <span class="bage" onclick="addmore()">Add</span></h1>
          <form method="POST" action="new.php">
            <input type="hidden" name="mail" value="<?php echo $mail; ?>">
            <button class="bage" type="submit" name="final" style="margin-top: 17px;height: 70px;"> Calculate</button>
          </form>
        </div>
        <div id="book" class="modal">
          <div class="modal-content">
            <span id="closeModal" class="close-btn" onclick="close()">&times;</span>
            <h2>Add New </h2>
            <form id="bookingForm" method="POST" action="del.php">
              <label for="date">Name :</label>
              <input type="text" id="date" name="date" required>

              <label for="guests">Cost:</label>
              <input type="number" id="guests" name="guests" required>

              <input type="hidden" name="mail" value="<?php echo $mail; ?>">
              <button type="submit" class="btn" name="cal">Done</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="ep hidden" id="ep">
    <div style="display: flex;justify-content: space-around;">
      <div>
        <header class="header">
        <h1>Edit your Profile:</h1>
        </header>
        <form method="POST" action="up.php">
        <input type="hidden" name="id" value="<?php echo $row['S_no']; ?>">
        <input type="hidden" name="serv" value="<?php echo $row['Service']; ?>">  
        <input type="hidden" name="pass" value="<?php echo $row['Password']; ?>">
        <input type="hidden" name="img" value="<?php echo $row['Image']; ?>">
        <input type="hidden" name="dt" value="<?php echo $row['Date']; ?>">
        <h4 style="font-weight: lighter;">Company's Name:</h4>        
        <div class="bage ext"><input type="text" pattern="^[A-Za-z\s]+$" title="Only letters allowed" name="cn" value="<?php $cn = $row['Company_name']; echo $cn; ?>"><img src="icons8-edit.svg" alt=""></div>
        <h4 style="font-weight: lighter;">Email:</h4>
        <div class="bage ext"><input type="email" pattern="^[^\s@]+@[^\s@]+\.[c]+[o]+[m]+$" title="Invalid email format" name="email" value="<?php $cn = $row['Email']; echo $cn; ?>"><img src="icons8-edit.svg" alt=""></div>
        <h4 style="font-weight: lighter;">Phone Number:</h4>
        <div class="bage ext"><input type="number" minlength="10" maxlength="10" name="pn" value="<?php $cn = $row['Phone_number']; echo $cn; ?>"><img src="icons8-edit.svg" alt=""></div>
        <h4 style="font-weight: lighter;">State:</h4>
        <div class="bage ext"><input type="text" pattern="^[A-Za-z]+$" title="Only letters allowed" name="st" value="<?php $cn = $row['State']; echo $cn; ?>"><img src="icons8-edit.svg" alt=""></div>
        <h4 style="font-weight: lighter;">District:</h4>
        <div class="bage ext"><input type="text" pattern="^[A-Za-z]+$" title="Only letters allowed" name="dis" value="<?php $cn = $row['District']; echo $cn; ?>"><img src="icons8-edit.svg" alt=""></div>
        <h4 style="font-weight: lighter;">About:</h4>
        <div class="bage ext"><input type="text" pattern="^[A-Za-z\s]+$" title="Only letters allowed" name="abt" value="<?php $cn = $row['About']; echo $cn; ?>"><img src="icons8-edit.svg" alt=""></div>
      </div>
    </div>
    <div class="forc">
      <div class="bage ba" onclick="hidep()">Cancle</div>
      <button type="submit" name="dn"><div class="bage ba">Done</div></button>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="rrr.js"></script>      
</body>

</html>
  
  
    