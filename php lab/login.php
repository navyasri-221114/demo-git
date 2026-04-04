<?php
include 'db_connect.php';

if(isset($_POST['login'])){
    // Trimming via combination of ltrim/rtrim logic as per string functions list
    $raw_username = ltrim(rtrim($_POST['username']));
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$raw_username'";
    $result = $conn->query($sql);

    // Stop execution for database or logic errors using die()
    if(!$result) {
        die("Error fetching user data from the database.");
    }

    if($result->num_rows == 1){
        $row = $result->fetch_assoc();
        $db_username = $row['username'];
        
        // Handle case sensitivity & compare strings properly
        // strcasecmp() = case-insensitive string comparison
        if (strcasecmp($raw_username, $db_username) === 0) {
            
            // Checking exact case sensitivity using strcmp()
            if (strcmp($raw_username, $db_username) !== 0) {
                // Output Function 1: print
                print "<i>Notice: Username case does not perfectly match database records, but we authenticated you manually.</i><br>";
            }

            if(password_verify($password, $row['password'])){
                // Output Function 2: echo
                echo "<h3 style='color: green;'>Login absolutely successful! Authentication passed for " . htmlspecialchars($db_username) . ".</h3>";
            } else {
                echo "<h3 style='color: red;'>Invalid password!</h3>";
            }
        } else {
            // Output Function 3: die()
            die("Logic Error: Username match failed unpredictably during strcasecmp().");
        }
    } else {
        die("User not found or multiple user clash detected!");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
<h2>Login Page</h2>
<form method="post" action="">
    Username: <input type="text" name="username" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <input type="submit" name="login" value="Login">
</form>
</body>
</html>
