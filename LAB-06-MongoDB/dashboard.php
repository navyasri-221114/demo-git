
<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: index.html");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
</head>

<body>

<h2>Welcome <?php echo $_SESSION['user']; ?></h2>

<form action="logout.php" method="post">
<button type="submit">Logout</button>
</form>

</body>
</html>