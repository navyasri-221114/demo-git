<?php
// Google API Client config
require_once __DIR__ . '/vendor/autoload.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$client = new Google_Client();
$client->setClientId("YOUR_CLIENT_ID_PLACEHOLDER");
$client->setClientSecret("YOUR_CLIENT_SECRET_PLACEHOLDER");
$client->setRedirectUri("http://localhost:8000/google_Oauth.php");
$client->addScope("email");
$client->addScope("profile");
?>
