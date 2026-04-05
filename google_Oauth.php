<?php
require_once 'google_config.php';

if (isset($_SESSION['user_name'])) {
    header("Location: index.php");
    exit();
}

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    if (isset($token['error'])) {
        die("Google Authentication Error: " . htmlspecialchars($token['error_description']));
    }
    $client->setAccessToken($token['access_token']);
    $google_oauth = new Google_Service_Oauth2($client);
    $google_account_info = $google_oauth->userinfo->get();
    $_SESSION['user_name'] = $google_account_info->name;
    $_SESSION['user_email'] = $google_account_info->email;
    $_SESSION['user_picture'] = $google_account_info->picture;
    header("Location: index.php");
    exit();
} else {
    header("Location: " . filter_var($client->createAuthUrl(), FILTER_SANITIZE_URL));
    exit();
}
?>
