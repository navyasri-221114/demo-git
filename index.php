<?php
session_start();
?>





<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Department Of Music & Arts</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="images/logo.png">

    <!-- COMMON CSS -->
    <link rel="stylesheet" href="style.css">
</head>

<body>

<!-- HEADER -->
<div class="header">
    <img src="images/Trio_music.jpg"
         alt="Tyagaraja Dikshitar Syama Sastri"
         class="left-img">

    <img src="images/Music.webp"
         alt="Tambura"
         class="right-img">

    <h1>Rajiv Gandhi University Of Knowledge And Technologies</h1>
    <h2>Department Of Music & Arts</h2>

    <marquee scrollamount="5" width="220" direction="right">
        <span class="swaras">స రి గ మ ప ద ని స</span>
    </marquee>
</div>

<!-- NAVBAR -->
<div class="navbar">
    <a href="index.html">Home</a>
    <a href="community.html">Community</a>
    <a href="courses.html">Courses</a>
    <a href="admissions.html">Admissions</a>
    <a href="contact.html">Contact</a>
    <a href="<?php echo isset($_SESSION['user_name']) ? 'logout.php' : 'google_Oauth.php'; ?>" style="background-color: #db4437; color: white; padding: 5px 10px; border-radius: 4px;">
        <?php
        if(isset($_SESSION['user_name'])){
            echo "Welcome " . htmlspecialchars($_SESSION['user_name']) . " | Logout";
        } else {
            echo "Sign in with Google";
        }
        ?>
    </a>
</div>

<!-- MAIN DASHBOARD -->
<div class="main">

    <!-- SIDEBAR -->
    <div class="sidebar">
        <ul>
            <li><a href="#">🎵 Classical Music</a></li>
            <li><a href="#">🎶 Vocal Training</a></li>
            <li><a href="#">🥁 Instruments</a></li>
            <li><a href="#">💃 Dance Arts</a></li>
            <li><a href="#">🎨 Fine Arts</a></li>
        </ul>
    </div>

    <!-- CONTENT -->
    <div class="content">
        <h2>Dashboard Overview</h2>

        <div class="cards">
            <div class="card">
                <h3>Courses</h3>
                <p>12 Available</p>
            </div>

            <div class="card">
                <h3>Students</h3>
                <p>350+</p>
            </div>

            <div class="card">
                <h3>Faculty</h3>
                <p>25</p>
            </div>

            <div class="card">
                <h3>Events</h3>
                <p>8 Upcoming</p>
            </div>
        </div>
     

        <!-- BUTTON TO NEXT PAGE -->
        <div style="margin-top: 40px; text-align: center;">
            <a href="tables.html">
                <button style="
                    padding: 12px 25px;
                    font-size: 16px;
                    font-weight: bold;
                    background-color: #003366;
                    color: white;
                    border: none;
                    border-radius: 8px;
                    cursor: pointer;
                ">
                    View Courses & Faculty →
                </button>
            </a>
        </div>

    </div>

</div>

</body>
</html>
