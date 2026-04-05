<?php
session_start();
include 'db_connect.php';
$message = "";

if(isset($_POST['login'])){
    // Clean input
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Validate email constraints
    if(strlen($email) == 0){
        die("<div style='color:red; text-align:center;'>Validation Error: Email cannot be empty. <a href='login.php'>Go Back</a></div>");
    }

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    // Stop execution using die() for database errors
    if(!$result) {
        die("<div style='color:red; text-align:center;'>Database query failed: " . $conn->error . "</div>");
    }

    // Fallback if db_connect failed or table is missing just for display
    if ($result->num_rows == 1){
        $row = $result->fetch_assoc();
        
        // Handling case sensitivity & strict comparison
        if(strcasecmp($email, $row['email']) !== 0){
            die("<div style='color:red; text-align:center;'>Strict validation failed: Email case mismatch. Please type exactly as registered. <a href='login.php'>Go Back</a></div>");
        }

        if(password_verify($password, $row['password'])){
            // Store username in session
            $_SESSION['username'] = $row['username'];
            $_SESSION['logged_in'] = true;
            $db_username = $row['username'];
            
            // Display messages using echo
            echo "<script>console.log('Login authenticated successfully.');</script>";

            $message = "<div class='success-msg'>Login successful! Welcome, <strong>$db_username</strong>. <a href='logout.php'>Logout</a></div>";
        } else {
            $message = "<div class='error-msg'>Invalid password!</div>";
        }
    } else {
        $message = "<div class='error-msg'>User not found!</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Login - Department Of Music & Arts</title>
    <link rel="icon" type="image/png" href="../images/logo.png">
    <link rel="stylesheet" href="../LAB-02/style.css">
    <script src="../LAB-02/script.js" defer></script>
</head>
<body>

<!-- HEADER -->
<div class="header">
    <img src="../images/Trio_music.jpg" alt="Tyagaraja Dikshitar Syama Sastri" class="left-img">
    <img src="../images/Music.webp" alt="Tambura" class="right-img">
    <h1>Rajiv Gandhi University Of Knowledge And Technologies</h1>
    <h2>Department Of Music & Arts</h2>
    <marquee scrollamount="5" width="220" direction="right">
        <span class="swaras">స రి గ మ ప ద ని స</span>
    </marquee>
</div>

<!-- NAVBAR -->
<div class="navbar">
    <a href="../LAB-02/index.html">Home</a>
    <a href="../LAB-02/about.html">About</a>
    <a href="../LAB-02/community.html">Community</a>
    <a href="../LAB-02/courses.html">Courses</a>
    <a href="../LAB-02/admissions.html">Admissions</a>
    <a href="../LAB-02/contact.html">Contact</a>
    <?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
        <span style="color: #aef; font-weight: bold; padding: 0 10px;">👤 <?php echo htmlspecialchars($_SESSION['username']); ?></span>
        <a href="logout.php" style="color: #ff6b6b; font-weight: bold;">Logout</a>
    <?php else: ?>
        <a href="login.php" style="color: yellow; font-weight: bold;">Login</a>
        <a href="register.php">Register</a>
    <?php endif; ?>
</div>

<!-- MAIN DASHBOARD -->
<div class="main">
    <div class="sidebar">
        <ul>
            <li><a href="#">🎵 Classical Music</a></li>
            <li><a href="#">🎶 Vocal Training</a></li>
            <li><a href="#">🥁 Instruments</a></li>
            <li><a href="#">💃 Dance Arts</a></li>
            <li><a href="#">🎨 Fine Arts</a></li>
        </ul>
    </div>

    <div class="content">
        <div class="auth-container">
            <h2>Account Login</h2>
            <?php echo $message; ?>
            <form method="post" action="" class="auth-form">
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" required>
                </div>
                <button type="submit" name="login" class="primary-btn" style="width: 100%;">Login</button>
                <p>Don't have an account? <a href="register.php">Register here</a></p>
            </form>
        </div>
    </div>
</div>

</body>
</html>
