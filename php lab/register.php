<?php
include 'db_connect.php';

if(isset($_POST['submit'])){
    // 1. Clean input using substring/trim functions
    // Using string functions to ensure there are no trailing/leading spaces
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // 2. Format username properly (ucwords, strtolower)
    // Ensures standardized DB formatting like "Navya Sri"
    $username = ucwords(strtolower($username));
    
    // Using Special Characters & Security Functions
    $username = htmlspecialchars(addslashes($username));

    // 3. Validate input length using strlen()
    if(strlen($username) < 4) {
        // 4. Stop execution using die() if validation fails
        die("Validation Error: Username must be at least 4 characters long.");
    }
    if(strlen($password) < 6) {
        die("Validation Error: Password must be at least 6 characters long.");
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$hashed_password', '$email')";
    
    if($conn->query($sql) === TRUE){
        // Output Functions (print used)
        print "<p style='color: green;'>Registration successful! Welcome, $username.</p>";
    } else {
        // Output Functions (die used for logic errors)
        die("Database Error occurred: " . $conn->error);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
<h2>Registration Page</h2>
<form method="post" action="">
    Username: <input type="text" name="username" required><br><br>
    Email: <input type="email" name="email" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <input type="submit" name="submit" value="Register">
</form>
</body>
</html>
