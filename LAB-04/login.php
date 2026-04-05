<?php
include 'db_connect.php';
$message = "";

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    // Fallback if db_connect failed or table is missing just for display
    if ($result && $result->num_rows == 1){
        $row = $result->fetch_assoc();
        if(password_verify($password, $row['password'])){
            $message = "<div class='success-msg'>Login successful! Welcome $username.</div>";
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
    <link rel="icon" type="image/png" href="C:/Users/Navya Sri/Pictures/Saved Pictures/logo.png">
    <link rel="stylesheet" href="../LAB-02/style.css">
    <script src="../LAB-03/script.js" defer></script>
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
    <a href="../LAB-02/index.html">Home</a>
    <a href="../LAB-02/about.html">About</a>
    <a href="../LAB-02/community.html">Community</a>
    <a href="../LAB-02/courses.html">Courses</a>
    <a href="../LAB-02/admissions.html">Admissions</a>
    <a href="../LAB-02/contact.html">Contact</a>
    <a href="login.php" style="color: yellow; font-weight: bold;">Login</a>
    <a href="register.php">Register</a>
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
                    <label>Username</label>
                    <input type="text" name="username" required>
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
