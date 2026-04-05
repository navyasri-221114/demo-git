<?php
// LAB-05: MINI FILE MANAGER LOGIC
$dir = '../LAB-05/uploads/';
@mkdir($dir, 0777, true);
$log = '../LAB-05/log.txt';

if (isset($_FILES['f']) && move_uploaded_file($_FILES['f']['tmp_name'], $dir . basename($_FILES['f']['name']))) {
    file_put_contents($log, date('Y-m-d H:i')." Upload: {$_FILES['f']['name']}\n", FILE_APPEND); // Mode a+ internally
}
if (isset($_GET['del']) && unlink($dir . basename($_GET['del']))) {
    file_put_contents($log, date('Y-m-d H:i')." Delete: {$_GET['del']}\n", FILE_APPEND);
    header("Location: index.php"); exit;
}
if (isset($_GET['dl']) && is_file($p = $dir . basename($_GET['dl']))) {
    file_put_contents($log, date('Y-m-d H:i')." Download: {$_GET['dl']}\n", FILE_APPEND);
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($p).'"');
    readfile($p); exit;
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Department Of Music & Arts</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../images/logo.png">

    <!-- COMMON CSS -->
    <link rel="stylesheet" href="style.css">

    <!-- INTERACTIVE JS -->
    <script src="script.js" defer></script>
</head>

<body>

    <!-- HEADER -->
    <div class="header">
        <img src="../images/Trio_music.jpg" alt="Tyagaraja Dikshitar Syama Sastri"
            class="left-img">

        <img src="../images/Music.webp" alt="Tambura" class="right-img">

        <h1>Rajiv Gandhi University Of Knowledge And Technologies</h1>
        <h2>Department Of Music & Arts</h2>

        <marquee scrollamount="5" width="220" direction="right">
            <span class="swaras">స రి గ మ ప ద ని స</span>
        </marquee>
    </div>

    <!-- NAVBAR -->
    <div class="navbar">
        <a href="index.html">Home</a>
        <a href="about.html">About</a>
        <a href="community.html">Community</a>
        <a href="courses.html">Courses</a>
        <a href="admissions.html">Admissions</a>
        <a href="contact.html">Contact</a>
        <a href="../LAB-04/login.php">Login</a>
        <a href="../LAB-04/register.php">Register</a>
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

            <!-- ===== INTERACTIVE JS SECTION ===== -->
            <div class="interactive-panel">
                <h2 style="margin-top:0;">Welcome Space</h2>
                <div id="welcome-message" class="welcome-msg">
                    Welcome Guest to the Music & Arts Department
                </div>
                
                <div class="interactive-tools">
                    <!-- Feature 1: Personalize -->
                    <div class="tool-box">
                        <button id="personalize-btn" class="primary-btn">Personalize Dashboard</button>
                    </div>

                    <!-- Feature 2: Event Object -->
                    <div class="event-box">
                        <h3 id="event-title">Loading Event...</h3>
                        <p id="event-seats">Loading Seats...</p>
                        <button id="book-ticket-btn" class="primary-btn" style="background-color: #660000;">Book Ticket</button>
                    </div>
                </div>
            </div>
            <!-- ===== END INTERACTIVE JS SECTION ===== -->

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

            <!-- LAB 05: MINI FILE MANAGER UI -->
            <div style="background:rgba(255,255,255,0.05); padding:20px; border-radius:8px; margin-top:20px; border:1px solid #444;">
                <h3 style="margin-top:0;">Admissions - Document Upload Portal</h3>
                <form method="post" enctype="multipart/form-data" style="margin-bottom:15px;">
                    <input type="file" name="f" required style="border:1px solid #777; padding:8px; color:white; border-radius:4px;">
                    <button type="submit" class="primary-btn">Upload</button>
                </form>
                <ul style="list-style:none; padding:0;">
                    <?php
                    $files = array_diff(scandir($dir), ['.','..']);
                    if(empty($files)) echo "<li>No documents uploaded yet.</li>";
                    foreach($files as $f) {
                        $sz = filesize($dir.$f);
                        $tm = date('Y-m-d H:i', filemtime($dir.$f));
                        echo "<li style='padding:8px 0; border-bottom:1px solid #444;'>
                            <strong>$f</strong> - $sz bytes ($tm) 
                            <span style='float:right;'>
                                <a href='?dl=".urlencode($f)."' style='color:#6bf; text-decoration:none; margin-right:15px;'>⬇ Download</a> 
                                <a href='?del=".urlencode($f)."' style='color:#ff6b6b; text-decoration:none;'>❌ Delete</a>
                            </span>
                        </li>";
                    }
                    ?>
                </ul>
            </div>

            <!-- BUTTON TO NEXT PAGE -->
            <div class="btn-container">
                <a href="tables.html">
                    <button class="primary-btn">
                        View Courses & Faculty →
                    </button>
                </a>
            </div>

        </div>

    </div>

</body>

</html>