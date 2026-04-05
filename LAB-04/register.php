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
    
    try {
        $result = $conn->query($sql);
        if($result === TRUE){
            print "<script>console.log('User registered successfully');</script>"; // Using print
            $message = "<div class='success-msg'>Registration successful! You can now <a href='login.php'>Login</a></div>";
        } else {
            // Output function and stop execution using die()
            die("<div style='color:red; text-align:center; padding: 20px;'>Database Error: " . $conn->error . "</div>");
        }
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() == 1062) {
            die("<div style='color:red; text-align:center; padding: 20px; font-family: sans-serif;'><h2>Registration Error</h2><p>The username '<b>$username</b>' or email is already taken! Please choose another one.</p><p><a href='register.php'>Go Back</a></p></div>");
        } else {
            die("<div style='color:red; text-align:center; padding: 20px;'>Database Exception: " . $e->getMessage() . "</div>");
        }
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

<?php include 'header.php'; ?>
<?php include 'navbar.php'; ?>

<!-- MAIN DASHBOARD -->
<div class="main">
    <?php include 'sidebar.php'; ?>

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
