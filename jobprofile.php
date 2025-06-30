<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true) {
 header("location:joblogin.php"); 
}
include 'dbconn.php';
$mail = $_SESSION['Email']; 
$fetchquery = "Select * from `job_info` where `Email`='$mail' ";
$fetchres = mysqli_query($conn, $fetchquery);
$row = mysqli_fetch_array($fetchres);
$cn = $row['Name'];
$fequery = "Select * from `job` WHERE `Email` ='$mail' ";
    $feres = mysqli_query($conn, $fequery);
    $nrows = mysqli_num_rows($feres);
    if($nrows>0){            
    $rows = mysqli_fetch_array($feres);
    $vmail= $rows['Vmail'];
    $sel = "Select * from `vendors_info` where `Email`='$vmail' ";
    $pr = mysqli_query($conn, $sel);
    $nam = mysqli_fetch_array($pr);
    if ($rows['Response']==1) {
        // echo "<div id='bookingModal' class='modal'>
        // <div class='modal-content slide-in'>
        //     <span class='close' onclick='closeBooking()'>&times;</span>
        //     <h2>Request sent</h2>
        // </div>
        // </div>";
        echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong>'.$nam['Company_name'].' Accepted Your Job Request.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
        </div>';
    }}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="st.css">
    <link rel="stylesheet" href="pr.css">
    <link rel="stylesheet" href="chat.css">
    <link rel="stylesheet" href="vpr.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <style>
        body {
            color: #6d6d6d;
            font-family: 'Louis Vuitton Font Intrepid', sans-serif;
        }

        .box {
            width: 34%;
            height: 35vh;
            padding: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin: 15px;
            background-color:rgb(236, 255, 243);
        }

        .all {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        body::-webkit-scrollbar {
            display: none;
        }
    </style>
</head>
<body>
    <!-- <nav style="width: 100%;height: 10vh;">
        <div class="opts">
            <div class="b" style="margin-left: 22px;"><img class="mb-4" src="log1-removebg-preview.png" alt=""
                    width="152" height="75" style="margin-left: -15px;">
            </div>
            <div class="sbar">
                <div>
                    <form role="search" style="display: flex;width: max-content;">
                        <img src="images.png" height="24px" width="20px"
                            style="letter-spacing: .025rem;transform: translate(-17px,6px);">
                        <input type="search" class="form-control" placeholder="Search for jobs" aria-label="Search">
                    </form>
                </div>
                <div>
                    <a href="jobprofile.html">
                        <img src="profile (3).svg" alt="mdo" width="62" height="36" class="rounded-circle">
                    </a>
                </div>
            </div>
        </div>
    </nav> -->
    <div class="hd">
        <h1 style="font-weight:lighter;font-size:xx-large;">Welcome, 
          <?php 
          echo $cn;
          ?>
        </h1>
      <div>
        <img src="log1-removebg-preview.png" alt="" width="152" height="65">
    </div>
    </div>
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" data-bs-interval="1500">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3"
                aria-label="Slide 4"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="4"
                aria-label="Slide 5"></button>
        </div>
        <div class="carousel-inner anime"
            style="height: 88vh;box-shadow: 1px 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19) ;">
            <div class="carousel-item active">
                <a href="#">
                    <img src="imgs/audience-1853662.jpg" class="d-block w-100" alt="..." height="750px"
                        style="background-size: cover;"></a>
                <div class="carousel-caption d-none d-md-block" style="transform: translateY(-95px);">
                    <h5>Music and Dj</h5>
                    <p>Find Wedding, Birthday Parties and Reception hosting and mc jobs</p>
                </div>
            </div>

            <div class="carousel-item">
                <a href="#">
                    <img src="gettyimages-1428674946-2048x2048.jpg" class="d-block w-100" alt="..." height="750px"
                        style="background-size: cover;"></a>
                <div class="carousel-caption d-none d-md-block" style="transform: translateY(-95px);">
                    <h5>Hospitality Jobs</h5>
                    <p>All type of guest attendes to waiters to handling guest stays and all</p>
                </div>
            </div>
            <div class="carousel-item ">
                <a href="main.html">
                    <img src="imgs/office-8828993.jpg" class="d-block w-100" alt="..." height="750px"
                        style="background-size: cover;"></a>
                <div class="carousel-caption d-none d-md-block" style="transform: translateY(-95px);">
                    <h5>Management and Cordinator Jobs</h5>
                    <p>Find recruiters who seek management staff and in need for an event coordinator</p>
                </div>
            </div>
            <div class="carousel-item">
                <a href="#">
                    <img src="imgs/mc.jpg" class="d-block w-100" alt="..." height="750px"
                        style="background-size: cover;"></a>
                <div class="carousel-caption d-none d-md-block" style="transform: translateY(-95px);">
                    <h5>Hosting Jobs</h5>
                    <p> Find Wedding, Birthday Parties and Reception hosting and mc jobs</p>
                </div>
            </div>
            <div class="carousel-item">
                <a href="#">
                    <img src="imgs/ai-generated-8520995.png" class="d-block w-100" alt="..." height="750px"
                        style="background-size:cover;"></a>
                <div class="carousel-caption d-none d-md-block" style="transform: translateY(-95px);">
                    <h5>Chef and Cooking Jobs</h5>
                    <p>Find recruiters who is hiring chef and extra cooking staff</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="search" style="margin:20px;height:12vh;">
        <form role="search" style="display: flex;align-items: center;width:100%;">
            <img src="images.png" height="24px" width="20px" alt="Search icon">
            <input type="search" class="form-control insearch" placeholder="Search Users" aria-label="Search">
        </form>
    </div>
    <div class="all" style="padding:20px">
        <?php 
            $fetchquery = "Select * from `ṛecruit`";
            $fetchres = mysqli_query($conn, $fetchquery);
            $numrows = mysqli_num_rows($fetchres);
            if($numrows>0){
            while($row = mysqli_fetch_array($fetchres)){?>
          
            <div class="box">
                <h1>Job: <?php echo $row['Job'] ?></h1>
                <h4>Job Description: <?php echo $row['Job_desc'] ?></h4>
                <div>Skills: <?php echo $row['Skills'] ?></div>
                <div>Location:<?php echo $row['Location'] ?> Date:<?php echo $row['Date'] ?></div>
                <?php
                $v=$row['vmail'];
                $qu= "Select * from `job` WHERE `Email`='$mail' AND `Vmail`='$v' ";
                $res = mysqli_query($conn, $qu);
                $nrows = mysqli_num_rows($res);
                
                if($nrows>0){
                    $rr = mysqli_fetch_array($res);
                    if ($rr['Response']==0) {
                    echo "<button class='be' style='background-color:orange;'>In Request</button>";
                    }else if ($rr['Response']==1) {
                    echo "<button class='be'>Accepted</button>";
                    }
                }
                else{
                ?>
                <form method="POST" action="jpr.php">
                    <input type="hidden" name="vm" value="<?php echo $row['vmail']; ?>">
                    <input type="hidden" name="cn" value="<?php echo $cn; ?>">
                    <input type="hidden" name="m" value="<?php echo $mail; ?>">
                    <button type="submit" class=" bage ba" style="width:30%" onclick="openBooking()">Apply Now</button>
                </form>
                <?php
                }
                ?>
            </div>
        <?php
            }}
            ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="vpr.js" defer></script>

</body>

</html>