<?php
session_start();
include 'dbconn.php';
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    echo "<script>alert('Kindly login to access chat');</script>";
    header("Location: main.php");
    exit();
}
if (isset($_GET['vendemail'])) {
    $vendor_email = $_GET['vendemail'];
    $query = "SELECT * FROM `vendors_info` WHERE `Email` = '$vendor_email' ";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $vendor = mysqli_fetch_assoc($result);
        $vendor_name = $vendor['Company_name'];
        $Desc = $vendor['About'];
        $st=$vendor['State'];
        $dis=$vendor['District'];
        $ig=$vendor['Image']; 
        $cont = $vendor['Phone_number'];
        } 
    else {
        echo "Vendor not found.";
        exit();
    }
} 
$username= $_SESSION['Email'];
if (isset($_POST['rev'])) {
    $rat = $_POST["rat"];
    $review = $_POST["review"];
    $sql="INSERT INTO `rating` (`Vendor`, `User`, `Review`, `Ratings`, `Date`) VALUES ('$vendor_email', '$username', '$review', '$rat', current_timestamp())";
    $result = mysqli_query($conn, $sql);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Profile</title>
    <link rel="stylesheet" href="vpr.css"><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="vpr.js" defer></script>
</head>
<body>
    <div class="connr">
        <!-- Header Section -->
        <header>
            <h1 class="fade-in">Vendor Profile</h1>
            <p class="fade-in delay">Find everything you need for your perfect event!</p>
        </header>

        <!-- Vendor Information Section -->
        <section class="profile-card slide-in">
            <div class="vendor-image">
                <img src="<?php echo'images/'.$ig; ?>" alt="Vendor Image">
            </div>
            <div class="vendor-info">
                <h2 class="highlight"><?php echo $vendor_name; ?></h2>
                <p><?php echo $Desc; ?></p>
                <!-- <p><strong>Price Per Plate:</strong> $25 - $50</p> -->
                <p><strong>Location:</strong><?php echo $st.",".$dis; ?></p>
                <button class="cta-button" onclick="openBooking()">Book Now</button>
            </div>
        </section>
        <p><strong>Contact No:</strong><?php echo $cont; ?></p>
        <!-- Menu/Services Section -->
        <!-- <section class="menu-section fade-in">
            <h2>Menu & Services</h2>
            <ul>
                <li>Appetizers: Spring Rolls, Bruschetta</li>
                <li>Main Course: Grilled Chicken, Vegan Lasagna</li>
                <li>Desserts: Cheesecake, Tiramisu</li>
                <li>Beverages: Mocktails, Wine</li>
            </ul>
        </section> -->
        <!-- Reviews Section -->
        <section class="reviews-section slide-in">
            <h2>Customer Reviews</h2>
            <div class="search">
                <form role="search" method="POST" style="display: flex;align-items: center;flex-direction:column;">
                    <div class="input-group mb-3" style="width:95vw">
                        <label class="input-group-text" for="inputGroupSelect01" class="btton">Give Ratings</label>
                        <select class="form-select" id="inputGroupSelect01" name="rat">
                            <option value="1" selected> ⭐ (1 Star)</option>
                            <option value="2">⭐⭐ (2 star)</option>
                            <option value="3">⭐⭐⭐ (3 star)</option>
                            <option value="4">⭐⭐⭐⭐ (4 star)</option>
                            <option value="5">⭐⭐⭐⭐⭐ (5 star)</option>
                        </select>
                     </div>  
                    <input type="text" name="review" class="form-control insearch" placeholder="Write review"
                    aria-label="Search">
                    <button type="submit" name="rev" class="bage ba">Submit</button>
                </form>
            </div>
            <?php 
            $fetchquery = "Select * from `rating`";
            $fetchres = mysqli_query($conn, $fetchquery);
            $numrows = mysqli_num_rows($fetchres);
            if($numrows>0){
            while($row = mysqli_fetch_array($fetchres)){?>
            <div class="review-card">
            <p> <strong> <?php echo $row['User'] ?>: </strong> <?php echo $row['Review'] ?> </p>
                <p>Rating:
                 <?php 
                 $x = $row['Ratings'];
                 while ($x>0) {
                    echo "⭐";
                    $x--;
                 }
                 ?></p>
            </div>
            <?php
            }}?>
        </section>
    </div>

    <!-- Booking Modal -->
    <div id="bookingModal" class="modal">
        <div class="modal-content slide-in">
            <span class="close" onclick="closeBooking()">&times;</span>
            <h2>Book <?php echo $vendor_name; ?></h2>
            <form action="ch2.php" method="POST">
                <label for="event-date">Event Date:</label>
                <input type="date" name="ed" id="event-date" required>
                <label for="guest-count">Number of Guests:</label>
                <input type="number" name="ng" id="guest-count" min="1" required>
                <label for="floatingInput">Event:</label>
                <select class="form-control" id="floatingInput" name="evnt" placeholder="" fdprocessedid="npc5"required>
                  <option value="Bd">Birthday</option>
                  <option value="Eng">Engagement</option>
                  <option value="Event">Corporate Event</option>
                  <option value="Wedding">Wedding</option>
                  <option value="Bsh">Baby Shower</option>
                  <option value="oth">Other</option>
                </select>
                <label for="special-requests">Special Requests:</label>
                <textarea id="special-requests" name="sr" pattern="^[A-Za-z\s]+$" title="Only letters and spaces allowed"></textarea>
                <input type="hidden" name="uname" value="<?php echo $username; ?>">
                <input type="hidden" name="vmail" value="<?php echo $vendor_email; ?>">
                <button type="submit" class="cta-button">Confirm Booking</button>
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