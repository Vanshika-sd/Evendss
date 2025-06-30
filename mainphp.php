<?php
include 'dbconn.php';
$results = [];
$search = "";
if (isset($_POST['search'])) {
    $vend = $_POST["vend"];
    $search = $_POST['search'];

    // Prepare the SQL query to avoid SQL injection
    $sql = "SELECT * FROM `vendors_info` WHERE `Service` LIKE ? OR `State` LIKE ?";
    
    if ($stmt = $conn->prepare($sql)) {
        // Bind the parameters (adding % for LIKE search)
        $searchTermVend = "%$vend%";
        $searchTermState = "%$search%";
        $stmt->bind_param('ss', $searchTermVend, $searchTermState);
        
        // Execute the query
        $stmt->execute();
        
        // Get the result
        $result = $stmt->get_result();
        
        // Check if we have results
        if ($result->num_rows > 0) {
            // Fetch all results
            while ($row = $result->fetch_assoc()) {
                $results[] = $row;
            }
        }
        
        // Close the statement
        $stmt->close();
    }
}

// If there are results, output the results, else output a "no results" message
if (!empty($results)) {
    foreach ($results as $row) {
        ?>
        <div class="vend">
            <div class="disp" style="background-image: url('images/<?php echo htmlspecialchars($row['Image']); ?>')">
                <h4 class="serv"><?php echo htmlspecialchars($row['Service']); ?></h4>
            </div>
            <div class="info">
                <h1 class="head"><?php echo htmlspecialchars($row['Company_name']); ?></h1>
                <div class="vch">
                    <div class="location">
                        <img src="icons8-location.gif" alt="" height="20px">
                        <?php echo htmlspecialchars($row['State']); ?>, <?php echo htmlspecialchars($row['District']); ?>
                    </div>
                    <form action="ch2.php" method="GET">
                        <input type="hidden" name="vendor_id" value="<?php echo htmlspecialchars($row['Email']); ?>">
                        <button type="submit" name="chat"><img src="chat (3).svg" height="34px"></button>
                    </form>
                </div>
            </div>
        </div>
        <?php
    }
} else {
    echo "<p>No results found.</p>";
}
?>
