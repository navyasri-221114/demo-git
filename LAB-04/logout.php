<?php
// Start the session so we can destroy it
session_start();

// Destroy all session data (logs the user out)
session_unset();
session_destroy();

// Redirect back to the login page
header("Location: login.php");
exit();
?>