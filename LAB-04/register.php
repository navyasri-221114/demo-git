<?php
session_start();
include 'db_connect.php';
$message = "";

if(isset($_POST['submit'])){
    // 1. Clean input using string functions
    $username = htmlspecialchars(trim($_POST['username']));
    $password = $_POST['password'];
    $email = htmlspecialchars(trim($_POST['email']));

    // 2. Format username properly
    $username = ucwords(strtolower($username));

    // 3. Validate input length
    if(strlen($username) < 3){
        // Output function and stop execution using die()
        die("<div style='color:red; text-align:center; padding: 20px; font-family: sans-serif;'><h2>Validation Failed</h2><p>Username must be at least 3 characters long.</p><p><a href='register.php'>Go Back</a></p></div>");
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$hashed_password', '$email')";
    
    $result = $conn->query($sql);
    if($result === TRUE){
        print "<script>console.log('User registered successfully');</script>"; // Using print
        $message = "<div class='success-msg'>Registration successful! You can now <a href='login.php'>Login</a></div>";
    } else {
        // Output function and stop execution using die()
        die("<div style='color:red; text-align:center; padding: 20px;'>Database Error: " . $conn->error . "</div>");
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Register - Department Of Music & Arts</title>
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
        <a href="login.php">Login</a>
        <a href="register.php" style="color: yellow; font-weight: bold;">Register</a>
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
            <h2>Create New Account</h2>
            <?php echo $message; ?>
            <form method="post" action="" class="auth-form">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" required>
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" required>
                </div>
                <button type="submit" name="submit" class="primary-btn" style="width: 100%;">Register Account</button>
                <p>Already have an account? <a href="login.php">Login here</a></p>
            </form>
        </div>
    </div>
</div>

</body>
</html>
