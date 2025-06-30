<?php
session_start();
include 'dbconn.php';
if (isset($_GET['vmail'])) {
  $vmail = $_GET['vmail'];
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jt = $_POST["jobTitle"];
    $jdesc = $_POST["jobDescription"];
    $skill = $_POST["skills"];
    $date = $_POST["date"];
    $loc = $_POST["location"];
    $sql = "INSERT INTO `ṛecruit` (`Job`, `Job_desc`, `Skills`, `Date`, `Location`, `vmail`) VALUES ('$jt', '$jdesc', '$skill', '$date', '$loc', '$vmail')";
    $result = mysqli_query($conn, $sql);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Staff Recruitment</title>
  <link rel="stylesheet" href="rec.css">
  <!-- <script src="rec.js" defer></script> -->
</head>
<body>
  <header class="header">
    <h1 class="title">Staff Recruitment</h1>
    <p class="subtitle">Find the right talent for your event</p>
  </header>

  <main class="container">
    <section class="form-section">
      <h2>Post a Job</h2>
      <form id="recruitmentForm" method="POST">
        <div class="form-group">
          <label for="jobTitle">Job Title</label>
          <input type="text" pattern="^[A-Za-z]+$" title="Only letters allowed" id="jobTitle" name="jobTitle" required>
        </div>

        <div class="form-group">
          <label for="jobDescription">Job Description</label>
          <textarea id="jobDescription" pattern="^[A-Za-z\s]+$" title="Only letters and spaces allowed" name="jobDescription" rows="4" required></textarea>
        </div>

        <div class="form-group">
          <label for="skills">Required Skills</label>
          <input type="text" pattern="^[A-Za-z]+$" title="Only letters allowed" id="skills" name="skills" placeholder="e.g., Cooking, Serving" required>
        </div>

        <div class="form-group">
          <label for="date">Event Date</label>
          <input type="date" id="date" name="date" required>
        </div>

        <div class="form-group">
          <label for="location">Location</label>
          <input type="text" pattern="^[A-Za-z\s]+$" title="Only letters and spaces allowed" id="location" name="location" required>
        </div>

        <button type="submit" class="btn-submit">Post Job</button>
      </form>
    </section>   
  </main> 
  <section class="job-listing-section">
      <h2>Available Jobs</h2>
      <ul id="jobList">
      <?php 
            $fetchquery = "Select * from `job` WHERE `Vmail` ='$vmail' ";
            $fetchres = mysqli_query($conn, $fetchquery);
            $numrows = mysqli_num_rows($fetchres);
            if($numrows > 0){
              while($rw = mysqli_fetch_array($fetchres)){
              $ml=$rw['Email'];
              $fquery = "Select * from `job_info` WHERE `Email` ='$ml' ";
              $feres = mysqli_query($conn, $fquery);             
              while($row = mysqli_fetch_array($feres)){?>
              <li>
              <h3><?php echo $row['Name'] ?></h3>
              <p><strong>Location:</strong> <?php echo $row['State'].",".$row['District'] ?></p>
              <p><strong>Qualification:</strong> <?php echo $row['Qualification'] ?></p>
              <p><strong>Skills:</strong><?php echo $row['Skills'] ?></p>
              <?php
                if($rw['Response']==1){
                  echo  "<button class='be'>Accepted</button> </div>";
                }else{
                  echo "<form method='GET' action='up.php'><input type='hidden' name='uname' value='".$row['Name']."'>
                        <input type='hidden' name='vmail' value='". $vmail ."'>
                       <button type='submit' class='bage ba' name='vc'>Accept</button></form></div>";
                }
              }
            }}
            ?>
            </li>
      </ul>
    </section>

  <footer class="footer">
    <p>&copy; 2024 Event Management Platform</p>
  </footer>
</body>
</html>