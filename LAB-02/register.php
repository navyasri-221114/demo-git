<?php
include 'db_connect.php';
$message = "";

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$hashed_password', '$email')";
    
    if($conn->query($sql) === TRUE){
        $message = "<div class='success-msg'>Registration successful! You can now <a href='login.php'>Login</a></div>";
    } else {
        $message = "<div class='error-msg'>Error: " . $conn->error . "</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Register - Department Of Music & Arts</title>
    <link rel="icon" type="image/png" href="C:/Users/Navya Sri/Pictures/Saved Pictures/logo.png">
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>
<body>

<!-- HEADER -->
<div class="header">
    <img src="C:/Users/Navya Sri/Pictures/Saved Pictures/Trio_music.jpg" alt="Tyagaraja Dikshitar Syama Sastri" class="left-img">
    <img src="C:/Users/Navya Sri/Pictures/Saved Pictures/Music.webp" alt="Tambura" class="right-img">
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
    <a href="login.php">Login</a>
    <a href="register.php" style="color: yellow; font-weight: bold;">Register</a>
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
