
<?php
include 'dbconn.php';
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true) {
 header("location:signup.php");
 exit(); 
}
$email = $_SESSION['Email']; 
$query = "SELECT * FROM `vendors_info` WHERE `Email` = '$email' ";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $serv = $row['Service'];
} 
else {
    echo "Vendor not found.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Profile Creation</title>
    <link rel="stylesheet" href="sinp.css">
    <script src="sinp.js" defer></script>
</head>
<body>
    <!-- Animated Popup -->
    <div class="popup-overlay" id="popupOverlay">
        <div class="popup-content">
            <div class="checkmark-container">
                <div class="checkmark"></div>
            </div>
            <h2>Profile Created Successfully</h2>
            <button class="popup-btn" id="okBtn">OK</button>
        </div>
    </div>

        <form id="vendorForm">

            <!-- Form Fields for Caterer -->
             <?php 
             if ($serv == 'caterer') {
             ?> 
            <div id="catererFormFields" class="vendor-fields">
                <label for="pricePerPlate">Price per Plate:</label>
                <input type="number" id="pricePerPlate" name="pricePerPlate">

                <label for="menu">Menu Options:</label>
                <textarea id="menu" name="menu"></textarea>

                <label for="budgetPlans">Different Budget Plans:</label>
                <textarea id="budgetPlans" name="budgetPlans"></textarea>

                <label for="budgetPlans">type of cousin:</label>
                <textarea id="budgetPlans" name="budgetPlans"></textarea>
            </div>  
            <?php
            }
            ?>

            <!-- Form Fields for Decorator -->
            <div id="decoratorFormFields" class="vendor-fields">
                <label for="venueBudget">Avg Budget :</label>
                <input type="number" id="venueBudget" name="venueBudget">

                <label for="guestCount">Number of Guests:</label>
                <input type="number" id="guestCount" name="guestCount">

                <label for="decorations">Type of Decorations:</label>
                <textarea id="decorations" name="decorations"></textarea>
            </div>

            <button type="submit">Submit</button>
        </form>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Vendor Hub</p>
    </footer>
</body>
</html>
