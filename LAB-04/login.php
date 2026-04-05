<?php
session_start();
include 'db_connect.php';
$message = "";

if(isset($_POST['login'])){
    // Clean input to match registration side
    $email = htmlspecialchars(trim($_POST['email']));
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

<?php include 'header.php'; ?>
<?php include 'navbar.php'; ?>

<!-- MAIN DASHBOARD -->
<div class="main">
    <?php include 'sidebar.php'; ?>

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
